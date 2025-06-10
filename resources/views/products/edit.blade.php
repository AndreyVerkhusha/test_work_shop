@extends('layout')

@section('content')
    <div class="container container-width mt-1">
        <h1 class="mb-4 text-primary fw-bold border-bottom pb-2">
            ✏️ Редактировать продукт: {{ $product->name }}
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" class="mb-5">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Название</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label fw-semibold">Цена (в рублях)</label>
                <input type="number" step="0.01" min="0" name="price" id="price" class="form-control" value="{{ old('price', $product->price / 100) }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label fw-semibold">Категория</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ __('categories.' . $category->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Описание</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-save me-1"></i> Сохранить изменения
            </button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary ms-2">Отмена</a>
        </form>
    </div>
@endsection
