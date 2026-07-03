<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('products', 'slug')->ignore($productId)],
            'model_number' => ['nullable', 'string', 'max:100'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096', 'dimensions:min_width=400,min_height=300'],
            'specifications' => ['nullable', 'array'],
            'specifications.*.key' => ['required_with:specifications', 'string', 'max:100'],
            'specifications.*.value' => ['required_with:specifications', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['sometimes', 'boolean'],
        ];
    }
}
