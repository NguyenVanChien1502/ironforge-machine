<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreInquiryRequest;
use App\Http\Resources\Api\V1\InquiryResource;
use App\Models\Inquiry;

class InquiryController extends ApiController
{
    public function store(StoreInquiryRequest $request)
    {
        $inquiry = Inquiry::create([
            ...$request->validated(),
            'is_read' => false,
        ]);

        $inquiry->load('product');

        return response()->json([
            'message' => 'Yêu cầu đã được tiếp nhận.',
            'data' => new InquiryResource($inquiry),
        ], 201);
    }
}
