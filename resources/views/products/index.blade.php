@extends('layout')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('content')
    <div class="container container-width mt-1">
        <div class="d-flex justify-content-between border-bottom align-items-center mb-4">
            <h1 class="text-primary fw-bold">
                📦 Список товаров
            </h1>
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Добавить товар
            </a>
        </div>

        <table class="table table-hover table-bordered align-middle shadow-sm">
            <thead class="table-primary text-center text-uppercase">
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="fw-semibold">{{ $product->name }}</td>
                    <td class="text-success text-center" style="min-width: 100px;">
                        {{ number_format($product->price / 100, 2, ',', ' ') }} ₽
                    </td>
                    <td class="text-muted text-center">{{ __('categories.' . $product->category->name) }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" title="Просмотр" style="min-width: 90px;">
                                <i class="bi bi-eye me-1"></i> Просмотр
                            </a>

                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Удалить товар {{ addslashes($product->name) }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center" title="Удалить">
                                    <i class="bi bi-trash me-1"></i> Удалить
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center fst-italic text-secondary">Товары не найдены</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
