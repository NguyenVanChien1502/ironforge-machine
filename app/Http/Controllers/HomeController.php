<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Post;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        $featuredProducts = Product::with('category')
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $allProducts = Product::with('category')
            ->latest()
            ->take(12)
            ->get();

        $latestPosts = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $testimonials = Testimonial::visible()
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('categories', 'featuredProducts', 'allProducts', 'latestPosts', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }
}
