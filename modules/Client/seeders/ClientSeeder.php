<?php

namespace Modules\Client\seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Client\src\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 1; $i < 5; $i++) {
            $user = new Client();
            $user->name = "Hoàng Nam ". rand(0,100);
            $user->email = 'hoangnam'.rand(0,100).'@gmail.com';
            $user->password = Hash::make('111111');
            $user->is_active = 1;
            $user->save();
        }

    }
}
