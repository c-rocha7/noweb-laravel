<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\API\StorePostRequest;
use App\Http\Requests\API\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = Post::with('user:id,name')->latest()->paginate(15);
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $post = $request->user()->posts()->create($request->validated());
        return response()->json([
            'message' => 'Postagem criada com sucesso!',
            'post' => $post->load('user:id,name')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($post->load('user:id,name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        if ($request->user()->id !== $post->user_id) {
             return response()->json(['message' => 'Você não tem permissão para editar esta postagem.'], 403);
        }

        $post->update($request->validated());
        return response()->json([
            'message' => 'Postagem atualizada com sucesso!',
            'post' => $post->load('user:id,name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post): JsonResponse
    {
        if ($request->user()->id !== $post->user_id) {
             return response()->json(['message' => 'Você não tem permissão para excluir esta postagem.'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Postagem excluída com sucesso!']);
    }
}
