<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Neurología',
            'Quirúrgica',
            'Pediatría',
            'Cardiología',
            'Urología',
            'Medicina forense',
            'Dermatología'
        ];
        foreach ($specialties as $specialty){
            Speciality::create([
                'name'=> $specialty
            ]);
        }
    }
}
