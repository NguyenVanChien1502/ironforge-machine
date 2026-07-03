<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

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

        return view('home', compact('categories', 'featuredProducts', 'allProducts'));
    }
}
