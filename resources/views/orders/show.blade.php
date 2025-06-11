@extends('layout')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@section('content')
    <div class="container container-width mt-1">
        <h1 class="mb-4 text-primary fw-bold border-bottom pb-2">
            📦 Карточка заказа: #{{ $order->id }}
        </h1>

        <div class="card shadow-sm border-0 mb-1">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3 text-muted fw-semibold">ФИО покупателя</dt>
                    <dd class="col-sm-9 fs-6">{{ $order->full_name ?? '—' }}</dd>

                    <dt class="col-sm-3 text-muted fw-semibold">Дата создания</dt>
                    <dd class="col-sm-9 fs-6">{{ $order->created_at }}</dd>

                    <dt class="col-sm-3 text-muted fw-semibold">Статус</dt>
                    <dd class="col-sm-9 fs-6">
                        @if($order->status === 'completed')
                            <span class="badge bg-success">Выполнен</span>
                        @else
                            <span class="badge bg-secondary">Новый</span>
                        @endif
                    </dd>
                    <dt class="col-sm-3 text-muted fw-semibold">Наименование товара</dt>
                    <dd class="col-sm-9 fs-6">{{ $order->product->name }}</dd>

                    <dt class="col-sm-3 text-muted fw-semibold">Количество товаров</dt>
                    <dd class="col-sm-9 fs-6">{{ $order->quantity }}</dd>

                    <dt class="col-sm-3 text-muted fw-semibold">Категория товара</dt>
                    <dd class="col-sm-9 fs-6">{{ __('categories.' . $order->product->category->name) }}</dd>

                    @if(!empty($order->comment))
                        <dt class="col-sm-3 text-muted fw-semibold">Комментарий покупателя</dt>
                        <dd class="col-sm-9 fs-6">{{ $order->comment }}</dd>
                    @endif

                    <dt class="col-sm-3 text-muted fw-semibold">Итоговая цена</dt>
                    <dd class="col-sm-9 fs-6 text-success fw-bold">
                        {{ number_format($order->totalPrice / 100, 2, ',', ' ') }} ₽
                    </dd>
                </dl>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <form action="{{ route('orders.complete', $order->id) }}" method="POST" class="d-inline">
                @csrf
                <button
                    @if ($order->status === 'completed') disabled @endif
                type="submit"
                    class="btn btn-success"
                    title="Отметить как выполнен"
                    style="min-width: 180px;">
                    <i class="bi bi-check-circle me-1"></i> Отметить как выполнен
                </button>
            </form>

            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Редактировать
            </a>

            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Назад к списку заказов
            </a>
        </div>
    </div>
@endsection
