@extends('layout')

@section('content')
    <div class="container container-width mt-1">
        <h1 class="mb-4 text-success fw-bold border-bottom pb-2">
            ➕ Создать новый товар
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

        <form action="{{ route('products.store') }}" method="POST" class="mb-5">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Название</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label fw-semibold">Цена (в рублях)</label>
                <input type="number" step="0.01" min="0" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label fw-semibold">Категория</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="" disabled selected>Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ __('categories.' . $category->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Описание</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Создать
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Отмена</a>
        </form>
    </div>
@endsection
