<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            ['name' => 'Higher National Diploma', 'abv' => 'HND'],
            ['name' => 'National Diploma', 'abv' => 'ND'],
            ['name' => 'National Diploma Special', 'abv' => 'NDS'],
            ['name' => 'National Certificate in Education', 'abv' => 'NCE'],
            ['name' => 'Polytechnic Diploma', 'abv' => 'PD'],
        ];
        Program::insert($programs);
    }
}
