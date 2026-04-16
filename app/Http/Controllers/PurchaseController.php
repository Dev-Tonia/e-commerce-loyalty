<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class PurchaseController extends Controller
{
    use ApiResponse;

    public function store(StorePurchaseRequest $request, User $user): JsonResponse
    {
        // 1. Create the purchase 
        $purchase = Purchase::create([
            'user_id'   => $user->id,
            'item_name' => $request->item_name,
            'amount'    => $request->amount,
        ]);


        return $this->successResponse(
            [
                'purchase' => new PurchaseResource($purchase),
                'total_purchases' => $user->purchases()->count(),
            ],
            'Purchase recorded successfully',
            201
        );
    }
}
