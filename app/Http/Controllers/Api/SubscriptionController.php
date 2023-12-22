<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\Store;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{
    public function store(Store $request, Website $website): JsonResponse
    {
        $validated = $request->validated();
        $subscription = $website->subscribers()->create([
            'email' => $validated['email']
        ]);

        return response()->json([
            'message'      => 'Subscription created successfully',
            'subscription' => $subscription
        ], Response::HTTP_CREATED);
    }
}
