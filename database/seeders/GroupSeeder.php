<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::where('role', 'student')->get();

        // Groep 1: Webdesign
        $group1 = Group::create([
            'name'        => 'Webdesign Project',
            'description' => 'Samenwerken aan de eindopdracht webdesign',
            'owner_id'    => $students->random()->id,
            'join_code' => Str::random(8),
        ]);

        // Groep 2: Programmeren
        $group2 = Group::create([
            'name'        => 'PHP & Laravel',
            'description' => 'Oefenen met OOP en frameworks',
            'owner_id'    => $students->random()->id,
            'join_code'   => Str::random(8),
        ]);

        // Leden toevoegen (random 2-4 per groep)
        $group1->members()->attach($students->random(rand(2, 4))->pluck('id'));
        $group2->members()->attach($students->random(rand(2, 4))->pluck('id'));

        // Zorg dat eigenaar ook lid is
        $group1->members()->syncWithoutDetaching($group1->owner_id);
        $group2->members()->syncWithoutDetaching($group2->owner_id);

        $this->command->info('Studiegroepen geseeded: 2 groepen met leden');
    }
}