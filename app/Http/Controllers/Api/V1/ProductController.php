<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    public function index(Request $request)
    {
        $products = $this->query($request)
            ->paginate($this->perPage($request, 12))
            ->withQueryString();

        return ProductResource::collection($products);
    }

    public function featured(Request $request)
    {
        $products = $this->query($request)
            ->featured()
            ->paginate($this->perPage($request, 12))
            ->withQueryString();

        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return response()->json([
            'data' => new ProductResource($product),
            'related_products' => ProductResource::collection($relatedProducts),
        ]);
    }

    private function query(Request $request): Builder
    {
        $query = Product::with('category')->latest();

        if ($search = trim((string) $request->string('search'))) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('model_number', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->string('category')->trim()->toString()) {
            $query->whereHas('category', function (Builder $builder) use ($category) {
                if (is_numeric($category)) {
                    $builder->where('id', (int) $category);
                    return;
                }

                $builder->where('slug', $category);
            });
        }

        if ($request->boolean('featured')) {
            $query->featured();
        }

        return $query;
    }

    private function perPage(Request $request, int $default): int
    {
        return max(1, min((int) $request->integer('per_page', $default), 100));
    }
}
