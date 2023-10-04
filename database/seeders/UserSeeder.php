<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin user
        $userAdmin = new User([
            'photo'    => '/storage/images/default_user_image.png',
            'name'     => 'Jose Daniel Gonzalez Ochoa',
            'phone'    => '3127918088',
            'email'    => 'dajoseochoa23@gmail.com',
            'password' => bcrypt('123456789'),
            'remember_token'    => Str::random(25),
        ]);
        $userAdmin->save();
        $userAdmin->assignRole('admin');

        //Normal user
        $userClient = new User([
            'photo'    => '/storage/images/default_user_image.png',
            'name'     => 'Carlos Mena Perea',
            'phone'    => '3103993268',
            'email'    => 'carlos@gmail.com',
            'password' => bcrypt('123456789'),
            'remember_token'    => Str::random(25),
        ]);
        $userClient->save();
        $userClient->assignRole('user');
    }
}
