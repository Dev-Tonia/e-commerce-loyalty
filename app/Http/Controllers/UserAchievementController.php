<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Achievement;
use App\Models\Badge;
use App\Traits\ApiResponse;

class UserAchievementController extends Controller
{
    use ApiResponse;

    public function show(User $user)
    {
        $user->load(['achievements', 'badges']);

        // 1. Unlocked achievements
        $unlockedAchievements = $user->achievements
            ->pluck('name')
            ->toArray();

        // 2. Next available achievements
        $nextAvailableAchievements = Achievement::whereNotIn(
            'id',
            $user->achievements->pluck('id')
        )
            ->orderBy('required_purchases')
            ->pluck('name')
            ->toArray();

        // 3. Current badge (highest)
        $currentBadge = $user->badges
            ->sortByDesc('required_achievements')
            ->first();

        // 4. Next badge
        $totalAchievements = $user->achievements->count();

        $nextBadge = Badge::where('required_achievements', '>', $totalAchievements)
            ->orderBy('required_achievements')
            ->first();

        // 5. Remaining
        $remaining = $nextBadge
            ? $nextBadge->required_achievements - $totalAchievements
            : 0;

        return $this->successResponse([
            'unlocked_achievements' => $unlockedAchievements,
            'next_available_achievements' => $nextAvailableAchievements,
            'current_badge' => $currentBadge?->name,
            'next_badge' => $nextBadge?->name,
            'remaining_to_unlock_next_badge' => $remaining,
        ]);
    }
}
