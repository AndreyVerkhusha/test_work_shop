<?php

namespace App\Service;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;

class ProductService {
    public function index($perPage = 10, $page = 1) {
        return Product::orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function getAllCategories() {
        return Category::all();
    }

    public function store(ProductCreateRequest $request) {
        $data = $request->validated();
        $data['price'] = round($data['price'] * 100);

        return Product::create($data);
    }

    public function update(ProductUpdateRequest $request, Product $product) {
        $data = $request->validated();
        $data['price'] = round($data['price'] * 100);

        $product->update($data);

        return $product;
    }

    public function destroy(Product $product) {
        $product->delete();
    }
}
