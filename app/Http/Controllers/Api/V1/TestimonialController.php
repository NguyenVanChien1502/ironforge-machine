<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends ApiController
{
    public function index(Request $request)
    {
        $testimonials = Testimonial::visible()
            ->latest()
            ->paginate($this->perPage($request, 10))
            ->withQueryString();

        return TestimonialResource::collection($testimonials);
    }

    private function perPage(Request $request, int $default): int
    {
        return max(1, min((int) $request->integer('per_page', $default), 100));
    }
}
