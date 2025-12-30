<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image', 'description'];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }

    public function getImageUrlAttribute()
{
    return str_starts_with($this->image, 'products/')
        ? asset('storage/' . $this->image)
        : asset($this->image);
}

}
