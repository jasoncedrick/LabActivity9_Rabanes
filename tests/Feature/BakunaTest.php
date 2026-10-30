<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BakunaTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_resident_records(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/schedule')->assertRedirect('/login');
        $this->get('/login')->assertOk()->assertSee('Sign in');
    }

    public function test_seeded_user_can_login_view_pages_and_logout(): void
    {
        $this->seed();
        $this->post('/login', ['email' => 'nurse.rabanes@bakuna.test', 'password' => 'bakuna2026'])
            ->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $this->get('/dashboard')->assertOk()->assertSee('Bakuna Tracker - Purok Rabanes')
            ->assertSee('2 overdue vaccination(s)')->assertSee('Hi, '.config('bakuna.first_name'))
            ->assertViewHas('stats', fn ($stats) => array_column($stats, 'value') === [8, 2, 4, 2]);
        $this->get('/schedule')->assertOk()->assertSeeInOrder(['Jayson Tatum', 'Kevin Durant', 'Giannis Antetokounmpo']);
        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
        $this->get('/schedule')->assertRedirect('/login');
    }

    public function test_invalid_login_preserves_email_but_not_password(): void
    {
        $this->from('/login')->post('/login', ['email' => 'wrong@example.test', 'password' => 'wrong'])
            ->assertRedirect('/login')->assertSessionHasErrors('email')
            ->assertSessionHas('_old_input.email', 'wrong@example.test')
            ->assertSessionMissing('_old_input.password');
        $this->assertGuest();
        $this->post('/login', [])->assertSessionHasErrors(['email', 'password']);
    }

    public function test_empty_and_stock_notice_branches_render(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/dashboard')->assertOk()->assertSee('No schedules yet.')->assertSee('All clear');
        config(['bakuna.out_of_stock' => true]);
        $this->get('/dashboard')->assertOk()->assertSee('Vaccine stock notice')->assertDontSee('All clear');
    }

    public function test_seeder_covers_required_vaccines_and_configured_birthday(): void
    {
        config(['bakuna.birthday' => '2026-02-14']);
        $this->seed();
        $this->assertDatabaseCount('vaccinations', 8);
        foreach (['BCG', 'Pentavalent', 'OPV', 'MMR', 'Anti-Flu', 'Hepatitis B'] as $vaccine) {
            $this->assertDatabaseHas('vaccinations', ['vaccine' => $vaccine]);
        }
        $this->assertSame('2026-02-14', Vaccination::where('vaccine', 'Hepatitis B')->first()->scheduled_at->toDateString());
    }

    public function test_resident_output_is_escaped(): void
    {
        $this->seed();
        Vaccination::first()->update(['patient_name' => '<script>alert(1)</script>']);
        $this->actingAs(User::first())->get('/schedule')->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }
}
