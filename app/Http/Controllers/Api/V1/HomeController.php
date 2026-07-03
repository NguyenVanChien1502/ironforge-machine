<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Resources\Api\V1\PostResource;
use App\Http\Resources\Api\V1\ProductResource;
use App\Http\Resources\Api\V1\TestimonialResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends ApiController
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        $featuredProducts = Product::with('category')
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $latestPosts = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $testimonials = Testimonial::visible()
            ->latest()
            ->take(6)
            ->get();

        return response()->json([
            'data' => [
                'site' => [
                    'name' => 'Công Ty TNHH Hồ Nam',
                    'tagline' => 'Cảnh quan xanh, thi công và chăm sóc theo chuẩn vận hành thực tế',
                ],
                'settings' => $this->publicSettings(),
                'categories' => CategoryResource::collection($categories),
                'featured_products' => ProductResource::collection($featuredProducts),
                'latest_posts' => PostResource::collection($latestPosts),
                'testimonials' => TestimonialResource::collection($testimonials),
            ],
        ]);
    }
}
