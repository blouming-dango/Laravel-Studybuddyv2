<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::where('role', 'student')->get();

        foreach ($students as $student) {
            // 3-6 taken per student
            $count = rand(3, 6);
            for ($i = 0; $i < $count; $i++) {
                Task::create([
                    'user_id'     => $student->id,
                    'title'       => fake()->randomElement([
                        'Hoofdstuk 5 lezen', 'Opdracht 3A maken', 'Groepsverslag schrijven',
                        'Presentatie voorbereiden', 'Oefentoets oefenen', 'Artikel samenvatten',
                    ]),
                    'description' => fake()->sentence(8),
                    'deadline'    => now()->addDays(rand(1, 14)),
                    'priority'    => fake()->randomElement(['low', 'medium', 'high']),
                    'status'      => fake()->randomElement(['todo', 'in_progress', 'done']),
                ]);
            }
        }

        $this->command->info('Taken geseeded voor alle studenten');
    }
}