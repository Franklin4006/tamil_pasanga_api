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
        $user               = new User();
        $user->name         = "Franklin";
        $user->email        = "habidasf@gmail.com";
        $user->username     = "franklin";
        $user->mobile       = "6381394430";
        $user->dob          = "1998-12";
        $user->save();
    }
}
