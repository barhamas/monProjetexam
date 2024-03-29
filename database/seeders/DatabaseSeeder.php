<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Administrateur;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Administrateur::factory()->create([
            'nom' => 'Fall',
            'prenom'=> 'Awa',
            'email' => 'awafall01@gmail.com',
            'password' => 'passer',
        ]);

    }
}
