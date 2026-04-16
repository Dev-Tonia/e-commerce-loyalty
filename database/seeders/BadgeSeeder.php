<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            ['name' => 'Bronze',   'required_achievements' => 2],
            ['name' => 'Silver',   'required_achievements' => 4],
            ['name' => 'Gold',     'required_achievements' => 8],
            ['name' => 'Platinum', 'required_achievements' => 10],
        ];

        foreach ($badges as $badge) {
            Badge::firstOrCreate(
                ['name' => $badge['name']],  // check by name
                $badge                        // create with these values
            );
        }
        echo "Badges created successfully\n";
    }
}
