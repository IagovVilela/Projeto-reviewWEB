<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'token',
        'logo',
        'background_image',
        'negative_email',
        'contact_number',
        'business_website',
        'business_address',
        'google_business_url',
        'positive_score',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'positive_score' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($company) {
            if (empty($company->slug)) {
                $company->slug = Str::slug($company->name);
            }
            if (empty($company->token)) {
                $company->token = 'review_' . Str::random(20);
            }
        });
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewPages()
    {
        return $this->hasMany(ReviewPage::class);
    }

    public function getPublicUrlAttribute()
    {
        return url('/r/' . $this->token);
    }

    public function getPositiveReviewsCountAttribute()
    {
        return $this->reviews()->where('is_positive', true)->count();
    }

    public function getNegativeReviewsCountAttribute()
    {
        return $this->reviews()->where('is_positive', false)->count();
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
