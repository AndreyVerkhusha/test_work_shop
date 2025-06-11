@extends('layout')

@section('content')
    <div class="container container-width mt-1">
        <div class="d-flex justify-content-between border-bottom align-items-center mb-4">
            <h1 class="text-primary fw-bold">
                📦 Список заказов
            </h1>
            <a href="{{ route('orders.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Добавить заказ
            </a>
        </div>

        <table class="table table-hover table-bordered align-middle shadow-sm">
            <thead class="table-primary text-center text-uppercase">
            <tr>
                <th style="max-width: 35px;">ID</th>
                <th>Дата создания</th>
                <th style="min-width: 200px;">ФИО покупателя</th>
                <th style="max-width: 35px;">Статус</th>
                <th style="max-width: 50px;">Количество</th>
                <th>Итоговая цена</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td class="text-center">{{ $order->id }}</td>
                    <td class="text-center">{{ $order->created_at }}</td>
                    <td class="fw-semibold">{{ $order->full_name ?? '—' }}</td>
                    <td class="text-center">
                        @if($order->status === 'completed')
                            <span class="badge bg-success">Выполнен</span>
                        @else
                            <span class="badge bg-secondary">Новый</span>
                        @endif
                    </td>
                    <td class="text-center" style="min-width: 140px;">
                        {{ $order->quantity }}

                        <form action={{ route('orders.decrementQuantity', $order->id) }} method="POST" class="d-inline ms-2">
                            @csrf
                            <button type="submit" class="btn btn-icon btn-sm btn-danger p-1" title="Уменьшить количество"
                                    @if($order->quantity <= 1) disabled @endif
                                    style="width: 28px; height: 28px;">
                                <i class="fas fa-minus"></i>
                            </button>
                        </form>

                        <form action={{ route('orders.incrementQuantity', $order->id) }} method="POST" class="d-inline ms-1">
                            @csrf
                            <button type="submit" class="btn btn-icon btn-sm btn-primary p-1" title="Увеличить количество"
                                    style="width: 28px; height: 28px;">
                                <i class="fas fa-plus"></i>
                            </button>
                        </form>
                    </td>

                    <td class="text-success text-center" style="min-width: 100px;">
                        {{ number_format($order->totalPrice / 100, 2, ',', ' ') }} ₽
                    </td>
                    <td class="text-center">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary me-2" title="Просмотреть">
                            <i class="bi bi-eye"></i> Просмотреть
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center fst-italic text-secondary">Заказы не найдены</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
