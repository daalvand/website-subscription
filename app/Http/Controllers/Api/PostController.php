<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Store;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function store(Store $request, Website $website): JsonResponse
    {
        $validated = $request->validated();
        $post = $website->posts()->create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post'    => $post
        ], Response::HTTP_CREATED);
    }
}
