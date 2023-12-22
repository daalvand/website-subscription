<?php

namespace App\Http\Controllers\Api;

use App\Events\PostCreated;
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

        event(new PostCreated($post));

        return response()->json([
            'message' => 'Post created successfully',
            'post'    => $post
        ], Response::HTTP_CREATED);
    }
}
