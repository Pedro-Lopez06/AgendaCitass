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
            'role'=>'admin',
        ]);

        User::factory()
        ->count(30)
        ->create();
    }
}
