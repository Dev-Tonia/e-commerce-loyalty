<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessCashback
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
    public function handle(BadgeUnlocked $event): void
    {
        $user  = $event->user;
        $badge = $event->badge;

        // Simulate cashback payment
        $cashbackAmount = 300;

        $this->processMockPayment($user->id, $cashbackAmount, $badge->name);
    }

    private function processMockPayment(int $userId, int $amount, string $badgeName): void
    {
        // Log the cashback payment — simulating a payment provider
        Log::info(' Cashback Payment Processed', [
            'user_id'    => $userId,
            'amount'     => $amount,
            'badge'      => $badgeName,
            'currency'   => 'NGN',
            'status'     => 'success',
            'reference'  => 'CASHBACK_' . strtoupper($badgeName) . '_' . $userId . '_' . time(),
            'processed_at' => now()->toDateTimeString(),
        ]);
    }
}
