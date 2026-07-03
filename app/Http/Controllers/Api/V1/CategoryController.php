<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->paginate($this->perPage($request, 50));

        return CategoryResource::collection($categories);
    }

    public function show(Request $request, Category $category)
    {
        $category->loadCount('products');

        $products = $category->products()
            ->with('category')
            ->latest()
            ->paginate($this->perPage($request, 12));

        return response()->json([
            'data' => new CategoryResource($category),
            'products' => ProductResource::collection($products),
        ]);
    }

    private function perPage(Request $request, int $default): int
    {
        return max(1, min((int) $request->integer('per_page', $default), 100));
    }
}
