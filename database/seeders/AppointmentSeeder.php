<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentRsvp;
use App\Models\Group;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $groups = Group::all();

        foreach ($groups as $group) {
            // 1-3 afspraken per groep
            $count = rand(1, 3);
            for ($i = 0; $i < $count; $i++) {
                $appointment = Appointment::create([
                    'group_id'   => $group->id,
                    'subject'    => fake()->randomElement([
                        'Brainstorm sessie', 'Project voortgang', 'Code review',
                        'Presentatie oefenen', 'Deadline check-in',
                    ]),
                    'date_time'  => now()->addDays(rand(1, 10))->addHours(rand(9, 17)),
                    'location'   => fake()->randomElement(['Online (Teams)', 'Lokaal B3.12', 'Bibliotheek', null]),
                ]);

                // RSVPs voor leden
                foreach ($group->members as $member) {
                    AppointmentRsvp::create([
                        'appointment_id' => $appointment->id,
                        'user_id'        => $member->id,
                        'status'         => fake()->randomElement(['accepted', 'declined', 'pending']),
                    ]);
                }
            }
        }

        $this->command->info('Afspraken en RSVPs geseeded');
    }
}