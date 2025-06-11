<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Service\ProductService;

class ProductController extends Controller {
    public $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index(ProductRequest $request) {
        $page = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);
        $products = $this->productService->index($perPage, $page);

        // Сейчас используется в вёрстке для пагинации встроенный метод {{ $products->links() }}, но это просто для удобства.
        // В реальной практике по-хорошему, для фронта нужен будет примерно такой ответ в формате JSON:
        $data = [
            'data' => ProductResource::collection($products),
            'current_page' => $page,
            'per_page' => $perPage,
            'total_page' => $products->lastPage(),
            'total_products' => $products->total(),
        ];

        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = $this->productService->getAllCategories();

        return view('products.create', compact('categories'));
    }

    public function store(ProductCreateRequest $request) {
        $product = $this->productService->store($request);

        return redirect()->route('products.show', $product)->with('success', 'Товар успешно создан.');
    }

    public function show(Product $product) {
        $categories = $this->productService->getAllCategories();

        return view('products.show', compact('product', 'categories'));
    }

    public function edit(Product $product) {
        $categories = $this->productService->getAllCategories();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, Product $product) {
        $product = $this->productService->update($request, $product);

        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product) {
        $this->productService->destroy($product);

        return redirect()->back()
            ->with('success', 'Товар успешно удалён.');
    }
}
