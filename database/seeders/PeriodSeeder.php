<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use function Symfony\Component\Clock\now;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Period::create([
            'year' => Carbon::now()->year,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(3),
            'is_open' => 0,
            'name' => 'Periode Tahun ke ' . Carbon::now()->year
        ]);
    }
}
