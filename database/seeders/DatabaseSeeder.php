<?php

namespace Database\Seeders;

use App\Models\group as Group;
use App\Models\keywords;
use App\Models\specializations;
use App\Models\student;
use App\Models\teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\specializationFactory;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('012345678'),

        ]);
        

        specializations::factory(10)->create();
        Group::factory(1)->create();
        keywords::factory(10)->create();
    }
}
