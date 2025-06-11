<?php

namespace App\Models;

class Product extends BaseModel {
    protected $fillable = ['name', 'category_id', 'description', 'price'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
