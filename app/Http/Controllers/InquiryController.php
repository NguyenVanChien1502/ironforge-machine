<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request)
    {
        Inquiry::create($request->validated());

        return back()->with('success', 'Thank you! Your inquiry has been received. Our team will contact you shortly.');
    }
}
