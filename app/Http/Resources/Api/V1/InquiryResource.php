<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InquiryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
            'is_read' => $this->is_read,
            'product' => ProductResource::make($this->whenLoaded('product')),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
