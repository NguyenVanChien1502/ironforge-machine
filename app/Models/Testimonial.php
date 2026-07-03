<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'company',
        'avatar',
        'rating',
        'content',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'rating' => 'integer',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? Storage::disk('public')->url($this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->customer_name) . '&background=F59E0B&color=111827&bold=true';
    }

    protected static function booted(): void
    {
        static::deleting(function (Testimonial $testimonial) {
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
        });
    }
}
