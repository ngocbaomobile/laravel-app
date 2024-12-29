<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenityImage extends Model
{
    use HasFactory;

    protected $fillable = ['amenity_id', 'image_url'];

    public function getImageUrlAttribute($value)
    {
        return asset('storage/' . $value); // Generates the full URL
    }

    public function amenity()
    {
        return $this->belongsTo(Amenity::class);
    }
}
