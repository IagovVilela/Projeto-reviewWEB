<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'email',
        'logo_path',
        'background_image_path',
        'google_review_url',
        'positive_threshold',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'positive_threshold' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            if (empty($company->slug)) {
                $company->slug = Str::slug($company->name);
                
                // Garantir slug único
                $originalSlug = $company->slug;
                $count = 1;
                while (static::where('slug', $company->slug)->exists()) {
                    $company->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewPage(): HasOne
    {
        return $this->hasOne(ReviewPage::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function positiveReviews(): HasMany
    {
        return $this->reviews()->where('is_positive', true);
    }

    public function negativeReviews(): HasMany
    {
        return $this->reviews()->where('is_positive', false);
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 2);
    }

    public function getTotalReviewsAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }

    public function getBackgroundImageUrlAttribute(): ?string
    {
        return $this->background_image_path ? asset('storage/' . $this->background_image_path) : null;
    }
}

