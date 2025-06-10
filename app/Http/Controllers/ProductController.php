<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller {
    public function index(ProductRequest $request) {
        $page     = $request->query('page', 1);
        $perPage  = $request->query('perPage', 10);
        $products = Product::orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Сейчас используется в вёрстке для пагинации встроенный метод {{ $products->links() }}, но это просто для удобства.
        // В реальной практике по-хорошему, для фронта нужен будет примерно такой ответ в формате JSON:
        $data = [
            'data'           => ProductResource::collection($products),
            'current_page'   => $page,
            'per_page'       => $perPage,
            'total_page'     => $products->lastPage(),
            'total_products' => $products->total(),
        ];

        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(ProductCreateRequest $request) {
        $data          = $request->validated();
        $data['price'] = round($data['price'] * 100);
        $product       = Product::create($data);

        return redirect()->route('products.show', $product)->with('success', 'Продукт успешно создан.');
    }

    public function show(Product $product) {
        $categories = Category::all();

        return view('products.show', compact('product', 'categories'));
    }

    public function edit(Product $product) {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, Product $product) {
        $data          = $request->validated();
        $data['price'] = round($data['price'] * 100);
        $product->update($data);

        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product) {
        $product->delete();

        return redirect()->back()
            ->with('success', 'Продукт успешно удалён.');
    }
}
