<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['specifications'] = $this->formatSpecifications($request->input('specifications', []));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã tạo dự án thành công.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['specifications'] = $this->formatSpecifications($request->input('specifications', []));

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật dự án thành công.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Đã xóa dự án thành công.');
    }

    private function formatSpecifications(array $specifications): array
    {
        return collect($specifications)
            ->filter(fn ($spec) => filled($spec['key'] ?? null) && filled($spec['value'] ?? null))
            ->map(fn ($spec) => [
                'key' => Str::of($spec['key'])->trim()->toString(),
                'value' => Str::of($spec['value'])->trim()->toString(),
            ])
            ->values()
            ->all();
    }
}
