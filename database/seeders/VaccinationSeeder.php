<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use Illuminate\Database\Seeder;

class VaccinationSeeder extends Seeder
{
    public function run(): void
    {
        // NBA player names with fictional vaccination records for the classroom demonstration.
        $rows = [
            ['LeBron James', 'Davao City', 'BCG', '1st dose', '2026-11-03', 'Scheduled'],
            ['Stephen Curry', 'Davao City', 'Pentavalent', '2nd dose', '2026-11-05', 'Scheduled'],
            ['Kevin Durant', 'Davao City', 'OPV', '3rd dose', '2026-10-16', 'Done'],
            ['Giannis Antetokounmpo', 'Davao City', 'MMR', '1st dose', '2026-10-22', 'Overdue'],
            ['Luka Doncic', 'Davao City', 'Anti-Flu', 'Annual', '2026-10-24', 'Overdue'],
            ['Nikola Jokic', 'Davao City', 'Hepatitis B', '1st dose', config('bakuna.birthday') ?: '2026-11-12', 'Scheduled'],
            ['Jayson Tatum', 'Davao City', 'MMR', '2nd dose', '2026-10-12', 'Done'],
            ['Anthony Edwards', 'Davao City', 'OPV', '1st dose', '2026-11-09', 'Scheduled'],
        ];
        foreach ($rows as [$name, $purok, $vaccine, $dose, $date, $status]) {
            Vaccination::updateOrCreate(
                ['patient_name' => $name, 'vaccine' => $vaccine, 'dose' => $dose],
                ['purok' => $purok, 'scheduled_at' => $date, 'status' => $status],
            );
        }
    }
}
