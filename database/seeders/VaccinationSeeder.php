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
            ['LeBron James', 'Purok 1', 'BCG', '1st dose', '2026-11-03', 'Scheduled'],
            ['Stephen Curry', 'Purok 2', 'Pentavalent', '2nd dose', '2026-11-05', 'Scheduled'],
            ['Kevin Durant', 'Purok 3', 'OPV', '3rd dose', '2026-10-16', 'Done'],
            ['Giannis Antetokounmpo', 'Purok 1', 'MMR', '1st dose', '2026-10-22', 'Overdue'],
            ['Luka Doncic', 'Purok 4', 'Anti-Flu', 'Annual', '2026-10-24', 'Overdue'],
            ['Nikola Jokic', 'Purok 2', 'Hepatitis B', '1st dose', config('bakuna.birthday') ?: '2026-11-12', 'Scheduled'],
            ['Jayson Tatum', 'Purok 3', 'MMR', '2nd dose', '2026-10-12', 'Done'],
            ['Anthony Edwards', 'Purok 4', 'OPV', '1st dose', '2026-11-09', 'Scheduled'],
        ];
        foreach ($rows as [$name, $purok, $vaccine, $dose, $date, $status]) {
            Vaccination::updateOrCreate(
                ['patient_name' => $name, 'vaccine' => $vaccine, 'dose' => $dose],
                ['purok' => $purok, 'scheduled_at' => $date, 'status' => $status],
            );
        }
    }
}
