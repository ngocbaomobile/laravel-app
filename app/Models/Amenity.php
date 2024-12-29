<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_code', 'unit_name', 'price'];

    public function images()
    {
        return $this->hasMany(AmenityImage::class);
    }
}
