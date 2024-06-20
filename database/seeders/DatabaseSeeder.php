<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

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
        //UserModel::factory(30)->create();
        
        UserModel::factory()->create([
            'first_name' => 'Clarence Steve',
            'middle_name' => 'Alatiit',
            'last_name' => 'Alba',
            'username' => 'clarencegwapo',
            'password' => bcrypt('123'),
            'position' => 'Admin'
         ]);
    }
}
