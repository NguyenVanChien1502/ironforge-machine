<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'inquiries' => Inquiry::count(),
            'unread_inquiries' => Inquiry::where('is_read', false)->count(),
        ];

        $recentInquiries = Inquiry::with('product')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries'));
    }
}
