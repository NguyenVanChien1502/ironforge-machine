<?php

namespace App\Http\Controllers\Api\V1;

class SettingController extends ApiController
{
    public function index()
    {
        return response()->json([
            'data' => $this->publicSettings(),
        ]);
    }
}
