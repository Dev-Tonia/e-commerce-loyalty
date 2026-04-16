<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            ['name' => 'First Purchase',  'required_purchases' => 1],
            ['name' => '5 Purchases',     'required_purchases' => 5],
            ['name' => '10 Purchases',    'required_purchases' => 10],
            ['name' => '25 Purchases',    'required_purchases' => 25],
            ['name' => '50 Purchases',    'required_purchases' => 50],
        ];

        foreach ($achievements as $achievement) {
            Achievement::firstOrCreate(
                ['name' => $achievement['name']],  // check by name
                $achievement                        // create with these values
            );
        }
        echo "Achievement created successfully\n";
    }
}
