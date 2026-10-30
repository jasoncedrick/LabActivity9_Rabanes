<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use Illuminate\Database\Seeder;

class VaccinationSeeder extends Seeder
{
    public function run(): void
    {
        // Fictional residents for the classroom demonstration.
        $rows = [
            ['Mika Villanueva', 'Purok 1', 'BCG', '1st dose', '2026-11-03', 'Scheduled'],
            ['Enzo Cabrera', 'Purok 2', 'Pentavalent', '2nd dose', '2026-11-05', 'Scheduled'],
            ['Sofia Dizon', 'Purok 3', 'OPV', '3rd dose', '2026-10-16', 'Done'],
            ['Liam Mercado', 'Purok 1', 'MMR', '1st dose', '2026-10-22', 'Overdue'],
            ['Elena Salcedo', 'Purok 4', 'Anti-Flu', 'Annual', '2026-10-24', 'Overdue'],
            ['Rafael Lim', 'Purok 2', 'Hepatitis B', '1st dose', config('bakuna.birthday') ?: '2026-11-12', 'Scheduled'],
            ['Amara Bautista', 'Purok 3', 'MMR', '2nd dose', '2026-10-12', 'Done'],
            ['Nico Soriano', 'Purok 4', 'OPV', '1st dose', '2026-11-09', 'Scheduled'],
        ];
        foreach ($rows as [$name, $purok, $vaccine, $dose, $date, $status]) {
            Vaccination::updateOrCreate(
                ['patient_name' => $name, 'vaccine' => $vaccine, 'dose' => $dose],
                ['purok' => $purok, 'scheduled_at' => $date, 'status' => $status],
            );
        }
    }
}
