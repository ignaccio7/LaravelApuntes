<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(): JsonResponse
    public function index(): JsonResource
    {
        //
        // $posts = Post::all();
        // return response()->json([
        //     'ok' => true,
        //     // 'data' => $posts
        //     'data' => Post::all()
        // ], 200);
        // Si nos queremos apoyar en el resource que creamos anteriormente entonces deberiamos hacer lo siguiente
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): JsonResponse
    {
        $post = Post::create($request->all());
        return response()->json([
            'ok' => true,
            // 'data' => $post
            'data' => new PostResource($post)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $post = Post::find($id);
        return response()->json([
            'ok' => true,
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        //
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return response()->json([
            'ok' => true,
            'data' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Post::find($id)->delete();

        return response()->json([
            'ok' => true
        ], 200);
    }
}
