<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Service\OrderService;

class OrderController extends Controller {
    public $orderService;

    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function index(OrderRequest $request) {
        $page    = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);

        $ordersResource = $this->orderService->index($perPage, $page);

        return view('orders.index', [
            'orders' => $ordersResource,
        ]);
    }

    public function incrementQuantity(Order $order) {
        $this->orderService->incrementQuantity($order);

        return redirect()->back();
    }

    public function decrementQuantity(Order $order) {
        if ($this->orderService->decrementQuantity($order)) {
            return redirect()->back();
        }

        return redirect()->route('orders.index')->with('info', 'Минимальное количество — 1.');
    }

    public function complete(Order $order) {
        if ($this->orderService->complete($order)) {
            return redirect()->route('orders.show', $order)
                ->with('success', 'Статус заказа обновлён на "выполнен".');
        }

        return redirect()->route('orders.show', $order)
            ->with('info', 'Статус уже установлен как "выполнен".');
    }

    public function show(Order $order) {
        return view('orders.show', compact('order'));
    }

    public function create() {
        $products = $this->orderService->getAllProducts();

        return view('orders.create', compact('products'));
    }

    public function store(OrderCreateRequest $request) {
        $order = $this->orderService->store($request);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order) {
        $products = $this->orderService->getAllProducts();

        return view('orders.edit', compact('products', 'order'));
    }

    public function update(OrderUpdateRequest $request, Order $order) {
        $order         = $this->orderService->update($request, $order);
        $orderResource = new OrderResource($order);

        return redirect()->route('orders.show', $orderResource);
    }

    public function destroy(Order $order) {
        $this->orderService->destroy($order);

        return redirect()->back()
            ->with('success', 'Заказ успешно удалён.');
    }
}
