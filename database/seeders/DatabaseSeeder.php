<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Utilisateur par defaut

         \App\Models\User::factory()->create([
            'name' => 'Soro Daouda',
            'email' => 'soro.daouda@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Utilisateur par defaut

    }
}
