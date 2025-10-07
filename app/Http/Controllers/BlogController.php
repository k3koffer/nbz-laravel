<?php

namespace App\Http\Controllers;

use App\Actions\GetPostsAction;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Educator;

class BlogController extends Controller
{
    protected $allowedIps = [
        '127.0.0.1',
        '192.250.230.83',
        '83.215.234.49',
        '31.135.33.119'
    ];

        public function index(Request $request, GetPostsAction $getPostsAction)
    {
        $posts = $getPostsAction->execute($request);

        return Inertia::render('Index', [
            'posts' => $posts,
            'filters' => $request->only(['search', 'tags']),
            'query' => $request->query()
        ]);
    }

        public function admin(Request $request, GetPostsAction $getPostsAction)
    {
        $userIp = $request->ip();
        if (!in_array($userIp, $this->allowedIps)) {
            abort(403, 'У вас нет доступа к этому разделу.');
        }

        $posts = $getPostsAction->execute($request);
        $educators = Educator::all();
        return Inertia::render('Admin', [
            'posts' => $posts,
            'educators' => $educators,
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
                'created_at' => $post->created_at,
            ]
        ]);
    }
    //
}
