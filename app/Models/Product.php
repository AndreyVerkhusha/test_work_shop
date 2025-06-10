<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel {
    use SoftDeletes;

    protected $fillable = ['name', 'category_id', 'description', 'price'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
