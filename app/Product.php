<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
