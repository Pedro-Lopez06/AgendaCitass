<?php

namespace Database\Seeders;

use App\Models\Speciality;
use App\Models\User;
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
            'Medicina Forense',
            'Dermatología'
        ];
        foreach ($specialties as $specialtyName){
           $specialty = Speciality::create([
                'name'=> $specialtyName
            ]);
            $specialty->users()->saveMany(
                User::factory(4)->state(['role'=>'doctor'])->make()
            );
        }
        USer::find(3)->specialties()->save($specialty);
    }
}
