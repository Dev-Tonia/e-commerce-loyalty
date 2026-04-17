<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\PurchaseCompleted;
use App\Models\Achievement;

class CheckAchievements
{
    public function handle(PurchaseCompleted $event): void
    {
        $user           = $event->user;
        $totalPurchases = $user->purchases()->count();

        // 1. Get all achievements the user now qualifies for
        $qualifiedAchievements = Achievement::where('required_purchases', '<=', $totalPurchases)
            ->get();

        // 2. Loop through each qualified achievement
        foreach ($qualifiedAchievements as $achievement) {

            // 3. Check if user already has this achievement
            $alreadyUnlocked = $user->achievements()
                ->where('achievement_id', $achievement->id)
                ->exists();

            // 4. If it's new — attach it and fire AchievementUnlocked event
            if (!$alreadyUnlocked) {
                $user->achievements()->attach($achievement->id);

                AchievementUnlocked::dispatch($user, $achievement);
            }
        }
    }
}
