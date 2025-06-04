<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StorePostRequest;
use App\Http\Requests\API\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::with('user:id,name')->latest()->paginate(15);

        return response()->json($posts);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        // dd($request->user()->posts());

        $post = $request->user()->posts()->create($request->validated());

        // dd($post);

        return response()->json([
            'message' => 'Postagem criada com sucesso!',
            'post'    => $post->load('user:id,name'),
        ], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post->load('user:id,name'));
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        if ($request->user()->id !== $post->user_id) {
            return response()->json(['message' => 'Você não tem permissão para editar esta postagem.'], 403);
        }

        $post->update($request->validated());

        return response()->json([
            'message' => 'Postagem atualizada com sucesso!',
            'post'    => $post->load('user:id,name'),
        ]);
    }

    public function destroy(Request $request, Post $post): JsonResponse
    {
        if ($request->user()->id !== $post->user_id) {
            return response()->json(['message' => 'Você não tem permissão para excluir esta postagem.'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Postagem excluída com sucesso!']);
    }
}
