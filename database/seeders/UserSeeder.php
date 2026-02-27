<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin gebruiker
        User::create([
            'name'     => 'Admin Gebruiker',
            'email'    => 'admin@studybuddy.nl',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Enkele studenten
        $students = [
            ['name' => 'Anna de Vries',     'email' => 'anna@rocnova.nl'],
            ['name' => 'Mohammed Ali',       'email' => 'mohammed@rocnova.nl'],
            ['name' => 'Lisa Jansen',        'email' => 'lisa@rocnova.nl'],
            ['name' => 'Tom van Dijk',       'email' => 'tom@rocnova.nl'],
            ['name' => 'Sara van der Linden', 'email' => 'sara@rocnova.nl'],
        ];

        foreach ($students as $student) {
            User::create([
                'name'     => $student['name'],
                'email'    => $student['email'],
                'password' => Hash::make('student123'),
                'role'     => 'student',
            ]);
        }

        $this->command->info('Gebruikers geseeded: 1 admin + 5 studenten');
    }
}