<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Modules\Students\src\Models\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         Student::create([
             'name' => 'Nam',
             'email' => 'quachnam3010@gmail.com',
             'is_active'=> 1,
             'phone'=> '0819482734',
             'address'=> "Hà Nội",
             'password' => Hash::make('111111')
         ]);
//        $this->call(ClientSeeder::class);
    }
}
