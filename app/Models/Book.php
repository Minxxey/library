<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'cover_img',
        'description',
        'published_year',
        'language',
        'rating'
    ];

    public function categories() : HasMany
    {
        return $this->hasMany(BookCategory::class);
    }

    public function tags() : HasMany
    {
        return $this->hasMany(BookTag::class);
    }
}
