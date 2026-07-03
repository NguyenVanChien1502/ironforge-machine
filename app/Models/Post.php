<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'image',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : asset('images/placeholder-post.jpg');
    }

    protected static function booted(): void
    {
        static::deleting(function (Post $post) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
        });
    }
}
