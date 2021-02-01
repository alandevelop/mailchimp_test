<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\User::factory(10)->create();

        \App\Models\Subscription::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin_name',
            'email' => 'admin@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin_password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
