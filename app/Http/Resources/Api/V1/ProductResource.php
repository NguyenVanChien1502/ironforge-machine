<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'model_number' => $this->model_number,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'specifications' => $this->specifications ?? [],
            'is_featured' => $this->is_featured,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
