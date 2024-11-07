<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Cache::remember('users_index', 600, function () {
            return Post::with('user')->paginate(20);
        });

        if ($posts->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Post empty',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'posts' => $posts,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $slug = Str::slug($request['title']);

        if (Post::where('slug', $slug)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Title or Slug already exists',
            ], 422);
        }

        $post = Post::create([
            'title' => $request['title'],
            'slug' => $slug,
            'body' => $request['body'],
            'user_id' => $request['user_id'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Posts create success',
            'data' => $post,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'post' => $post,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $slug = Str::slug($request['title']);

        if (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Title or Slug already exists',
            ], 422);
        }

        $post->update([
            'title' => $request['title'],
            'slug' => $slug,
            'body' => $request['body'],
            'user_id' => $request['user_id'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post update success',
            'data' => $post,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
            ], 404);
        }

        $post->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post delete success',
        ], 200);
    }
}
