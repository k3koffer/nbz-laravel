<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'picture',
        'type',
        'creator_id',
        'content',
        'tags',
        // Добавьте сюда другие поля, если они есть
    ];

    protected static function boot () {
        parent::boot();

        static::creating(function ($post) {
            $post->link = Str::slug($post->title, '-', 'ru');
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Educator::class, 'creator_id');
    }
}
