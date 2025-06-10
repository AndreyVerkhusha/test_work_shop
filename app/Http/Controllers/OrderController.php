<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller {
    public function index(OrderRequest $request) {
        $page    = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);
        $orders  = Order::with('product')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        $ordersResource = OrderResource::collection($orders);

        return view('orders.index', [
            'orders' => $ordersResource,
        ]);
    }

    public function incrementQuantity(Order $order) {
        $order->increment('quantity');

        return redirect()->back();
    }

    public function decrementQuantity(Order $order) {
        if ($order->quantity > 1) {
            $order->decrement('quantity');

            return redirect()->back();
        }

        return redirect()->route('orders.index')->with('info', 'Минимальное количество — 1.');
    }

    public function complete(Order $order) {
        if ($order->status !== 'completed') {
            $order->update(['status' => 'completed']);

            return redirect()->route('orders.show', $order)
                ->with('success', 'Статус заказа обновлён на "выполнен".');
        }

        return redirect()->route('orders.show', $order)
            ->with('info', 'Статус уже установлен как "выполнен".');
    }

    public function show(Order $order) {
        return view('orders.show', compact('order'));
    }
}
