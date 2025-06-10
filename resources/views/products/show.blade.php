@extends('layout')

@section('content')
    <div class="container container-width mt-1">
        <h1 class="mb-4 text-primary fw-bold border-bottom pb-2">
            📦 Карточка продукта: {{ $product->name }}
        </h1>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3 text-muted fw-semibold">Название</dt>
                    <dd class="col-sm-9 fs-6">{{ $product->name }}</dd>

                    <dt class="col-sm-3 text-muted fw-semibold">Цена</dt>
                    <dd class="col-sm-9 fs-6 text-success fw-bold">
                        {{ number_format($product->price / 100, 2, ',', ' ') }} ₽
                    </dd>

                    <dt class="col-sm-3 text-muted fw-semibold">Категория</dt>
                    <dd class="col-sm-9 fs-6">{{ __('categories.' . $product->category->name) }}</dd>

                    <dt class="col-sm-3 text-muted fw-semibold">Описание</dt>
                    <dd class="col-sm-9 fs-6">{{ $product->description ?? '-' }}</dd>
                </dl>
            </div>
        </div>

        <div>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary me-2">
                <i class="bi bi-pencil me-1"></i> Редактировать
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Назад к списку
            </a>
        </div>
    </div>
@endsection
