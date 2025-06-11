<?php

namespace App\Service;

use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;

class OrderService {
    public function index(int $perPage = 10, int $page = 1) {
        return Order::with('product')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function incrementQuantity(Order $order) {
        $order->increment('quantity');
    }

    public function decrementQuantity(Order $order) {
        if ($order->quantity > 1) {
            $order->decrement('quantity');
            return true;
        }

        return false;
    }

    public function complete(Order $order): bool {
        if ($order->status !== 'completed') {
            $order->update(['status' => 'completed']);
            return true;
        }

        return false;
    }

    public function store(OrderCreateRequest $request): Order {
        $data = $request->validated();

        return Order::create($data);
    }

    public function update(OrderUpdateRequest $request, Order $order): Order {
        $data = $request->validated();
        $order->update($data);

        return $order;
    }

    public function getAllProducts() {
        return Product::all();
    }

    public function destroy(Order $order) {
        $order->delete();
    }
}
