<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "id" => 1,
                "name" => "Ad Ministrator",
                "email" => "admin@example.com",
                "password" => "Password1!",
            ],
            [
                "id" => 2,
                "name" => "YOUR NAME",
                "email" => "given@example.com",
                "password" => "Password1!",
            ],
            [
                "id" => 45,
                "name" => "Jacques d’Carre",
                "email" => "jacques@example.com",
                "password" => "Password1!",
            ],
            [
                "id" => 46,
                "name" => "Dee Leet",
                "email" => "dee@example.com",
                "password" => "Password1!",
            ],
            [
                "id" => 47,
                "name" => "Eileen Dover",
                "email" => "eileen@example.com",
                "password" => "Password1!",
            ],
            [
                "id" => 48,
                "name" => "Booker Holliday",
                "email" => "booker@example.com",
                "password" => "Password1!",
            ],
            [
                "id" => 49,
                "name" => "Fallon Dover",
                "email" => "fallon@example.com",
                "password" => "Password1!",
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }

    }
}
