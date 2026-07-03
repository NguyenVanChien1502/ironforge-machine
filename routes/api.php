<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\InquiryController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('home', [HomeController::class, 'index']);
    Route::get('settings', [SettingController::class, 'index']);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category:slug}', [CategoryController::class, 'show']);

    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/featured', [ProductController::class, 'featured']);
    Route::get('products/{product:slug}', [ProductController::class, 'show']);

    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post:slug}', [PostController::class, 'show']);

    Route::get('testimonials', [TestimonialController::class, 'index']);

    Route::post('inquiries', [InquiryController::class, 'store'])->middleware('throttle:30,1');
});
