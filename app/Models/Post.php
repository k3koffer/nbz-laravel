<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
     use HasFactory;
     
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Educator::class, 'creator_id');
    }
}
