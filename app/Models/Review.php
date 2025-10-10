<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Review extends Model
{
    use HasFactory;
    //
        protected $fillable = [
        'comment',
        'rating',
        'course',
        // 'user_id'
    ];


        protected function createdAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->format('d.m.Y H:i'), // Укажите любой нужный формат
        );
    }
    
    protected $appends = ['created_at_formatted'];
}
