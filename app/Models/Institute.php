<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'tagline', 'about', 'logo', 'cover_image',
        'city_id', 'category_id', 'area', 'pincode', 'full_address',
        'phone', 'whatsapp', 'email', 'website', 'rating', 'review_count',
        'students_trained', 'years_active', 'certifications', 'facilities',
        'socials', 'status', 'is_verified', 'is_featured',
    ];

    protected $casts = [
        'certifications' => 'array',
        'facilities'     => 'array',
        'socials'        => 'array',
        'is_verified'    => 'boolean',
        'is_featured'    => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(InstituteCategory::class, 'category_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function galleryItems()
    {
        return $this->hasMany(GalleryItem::class);
    }
}
