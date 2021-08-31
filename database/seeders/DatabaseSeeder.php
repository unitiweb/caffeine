<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create a demo user
        User::create([
            'name' => 'Demo Man',
            'email' => 'demo@mini.me',
            'password' => 'Testing01',
        ]);
    }
}
