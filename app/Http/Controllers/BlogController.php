<?php

namespace App\Http\Controllers;

use App\Actions\GetPostsAction;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BlogController extends Controller
{
        public function index(Request $request, GetPostsAction $getPostsAction)
    {
        $posts = $getPostsAction->execute($request);

        return Inertia::render('Index', [
            'posts' => $posts,
            'filters' => $request->only(['search', 'tags']),
            'query' => $request->query()
        ]);
    }

        public function show(Post $post)
    {
        $post->load('creator');
        
        return Inertia::render('Article', [
            'article' => [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
                'creator' => [
                    'name' => $post->creator->name,
                    'picture' => $post->creator->picture 
                ],
                'picture' => $post->picture,
                'type' => $post->type,
                'tags' => $post->tags,
                'content' => Str::markdown($post->content),
                'created_at' => $post->created_at->toFormattedDateString(),
            ]
        ]);
    }
    //
}
