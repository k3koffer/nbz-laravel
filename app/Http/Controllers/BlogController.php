<?php

namespace App\Http\Controllers;

use App\Actions\GetPostsAction;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Educator;
use function PHPUnit\Framework\isArray;

class BlogController extends Controller
{
        public function index(Request $request, GetPostsAction $getPostsAction)
    {
        $posts = $getPostsAction->execute($request);
        $sharedMeta = Inertia::getShared('meta') ?? [];

        return Inertia::render('Index', [
            'posts' => $posts,
            'filters' => $request->only(['search', 'tags']),
            'query' => $request->query(),
            'meta' => array_merge($sharedMeta, [
                'title' => 'Блог',
                'description' => 'Блог для тех, кто не перестал задавать вопросы. Разбираем самые неожиданные темы о мире, человеке и технологиях простыми и живыми словами. Читайте, чтобы смотреть на привычные вещи под совершенно новым углом.',
            ]),
        ]);
    }

        public function admin(Request $request, GetPostsAction $getPostsAction)
    {
        $posts = $getPostsAction->execute($request);
        $educators = Educator::all();

        $sharedMeta = Inertia::getShared('meta') ?? [];
        return Inertia::render('Admin', [
            'posts' => $posts,
            'educators' => $educators,
            'meta' => array_merge($sharedMeta, [
                'title' => 'Панель администратора (блог)',
                'description' => 'Панель администратора (блог)',
            ]),
        ]);
    }

        public function show(Post $post)
    {
        $post->load('creator');
        $sharedMeta = Inertia::getShared('meta') ?? [];

        $pictureAssoc = json_decode($post->picture, true);
        if (isset($pictureAssoc['path'])) {
            $pictureName = $pictureAssoc['path'];
        } else {
            $pictureName = 'notfound';
        }
        
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
            ],
            'meta' => array_merge($sharedMeta, [
                'title' => $post->title,
                'description' => $post->description,
                'image' => $pictureName,
                'type' => 'article'
            ]),
        ]);
    }
    //
}
