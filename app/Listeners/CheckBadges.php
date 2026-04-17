<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Models\Badge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckBadges
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AchievementUnlocked $event): void
    {
        $user               = $event->user;
        $totalAchievements  = $user->achievements()->count();

        // 1. Get the highest badge the user now qualifies for
        $qualifiedBadge = Badge::where('required_achievements', '<=', $totalAchievements)
            ->orderBy('required_achievements', 'desc')
            ->first();

        // 2. If no badge found, stop here
        if (!$qualifiedBadge) return;

        // 3. Check if user already has this badge
        $alreadyEarned = $user->badges()
            ->where('badge_id', $qualifiedBadge->id)
            ->exists();

        // 4. If it's new — attach it and fire BadgeUnlocked event
        if (!$alreadyEarned) {
            $user->badges()->attach($qualifiedBadge->id);

            BadgeUnlocked::dispatch($user, $qualifiedBadge);
        }
    }
}
