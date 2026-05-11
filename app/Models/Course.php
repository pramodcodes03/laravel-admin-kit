<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'institute_id', 'title', 'slug', 'category_slug', 'short_description',
        'long_description', 'thumbnail', 'gallery', 'duration_weeks',
        'hours_per_week', 'mode', 'level', 'language', 'price_inr',
        'original_price_inr', 'emi_available', 'certificate', 'placement_support',
        'rating', 'review_count', 'enrolled_count', 'highlights', 'what_you_learn',
        'prerequisites', 'curriculum', 'instructor', 'faqs', 'upcoming_batch',
        'tags', 'status',
    ];

    protected $casts = [
        'gallery'           => 'array',
        'mode'              => 'array',
        'language'          => 'array',
        'highlights'        => 'array',
        'what_you_learn'    => 'array',
        'prerequisites'     => 'array',
        'curriculum'        => 'array',
        'instructor'        => 'array',
        'faqs'              => 'array',
        'upcoming_batch'    => 'array',
        'tags'              => 'array',
        'emi_available'     => 'boolean',
        'certificate'       => 'boolean',
        'placement_support' => 'boolean',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
