<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'color', 'text_color',
        'cover_image', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function institutes()
    {
        return $this->hasMany(Institute::class, 'category_id');
    }
}
