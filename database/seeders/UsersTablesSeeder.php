<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jonathan',
            'email' => 'jony@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'cedula'=> '0465555550',
            'address'=> 'nose',
            'phone'=>'3318825712',
            'role'=>'admin'
        ]);
        User::create([
            'name' => 'paciente1',
            'email' => 'paciente1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'role'=>'paciente',
        ]);
        User::create([
            'name' => 'Medico1',
            'email' => 'medico1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'role'=>'doctor'
        ]);

        User::factory()
        ->count(50)
        ->state(['role'=> 'paciente'])
        ->create();
    }
}
