<?php

namespace App\Models;

class Order extends BaseModel {
    protected $fillable = ['full_name', 'status', 'comment', 'product_id', 'quantity'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function totalPrice() {
        return $this->product ? $this->product->price * $this->quantity : 0;
    }

    public function getTotalPriceAttribute() {
        return $this->totalPrice();
    }
}
