@extends('layout')

@section('content')
    <div class="container container-width mt-1">
        <h1 class="mb-4 text-primary fw-bold border-bottom pb-2">
            ➕ Создать заказ
        </h1>

        <form action="{{ route('orders.store') }}" method="POST" class="card shadow-sm border-0 mb-4 p-4">
            @csrf

            <div class="mb-3">
                <label for="full_name" class="form-label fw-semibold">ФИО покупателя</label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
                @error('full_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label fw-semibold">Товар</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="" disabled @if(old('product_id') === null) selected @endif>Выберите товар</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                            {{ $product->name }} — {{ number_format($product->price / 100, 2, ',', ' ') }} ₽
                        </option>
                    @endforeach
                </select>
                @error('product_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label fw-semibold">Количество</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" required>
                @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label fw-semibold">Комментарий</label>
                <textarea name="comment" id="comment" class="form-control" rows="3">{{ old('comment') }}</textarea>
                @error('comment') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Создать заказ
                </button>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Отмена
                </a>
            </div>
        </form>
    </div>
@endsection
