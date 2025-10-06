<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetPostsAction
{
    public function execute(Request $request)
    {
        $sortBy = $request->input('sortBy', 'new');

        return Post::query()
            ->select(['id', 'title', 'description', 'link', 'picture', 'type', 'content' ,'created_at', 'tags', 'creator_id'])
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->input('tags'), function ($query, $tags) {
                $query->where(function ($q) use ($tags) {
                    foreach ($tags as $tagId) {
                        $q->orWhereJsonContains('Tags', ['id' => (int)$tagId]);
                    }
                });
            })
            ->when($sortBy === 'best', function ($query) {
                // Если 'best', сортируем по просмотрам
                return $query->orderByDesc('views_count');
            }, function ($query) {
                // В противном случае (по умолчанию) — по дате создания
                return $query->latest();
            })
            ->paginate(10)
            ->withQueryString(); // Элегантно добавляем все параметры из URL к пагинации
    }
}