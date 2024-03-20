<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Client\seeders\ClientSeeder;
use Modules\Client\src\Models\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         Client::create([
             'name' => 'Nam',
             'email' => 'quachnam3010@gmail.com',
             'is_active'=> 1,
             'password' => Hash::make('111111')
         ]);
//        $this->call(ClientSeeder::class);
    }
}
