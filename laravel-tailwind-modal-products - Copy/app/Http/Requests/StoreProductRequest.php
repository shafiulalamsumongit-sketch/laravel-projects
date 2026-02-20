<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            //   'discount_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|integer|min:0',
            // 'status' => 'required|in:active,draft',
            // 'categories' => 'required|array',
            // 'categories.*' => 'exists:categories,id',
            //  'tags' => 'nullable|array',
            //  'tags.*' => 'string|max:50',
        ];

        /*
         * $validated = $request->validate([
         *         'category_id' => 'required|exists:categories,id',
         *         'name'        => 'required',
         *         'sku'         => 'required|unique:products',
         *         'price'       => 'required|numeric',
         *         'stock'       => 'required|integer',
         *         'main_image'  => 'required|image',
         *     ]);
         */
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            // 'price.required' => 'Price is required',
            //  'discount_price.lt' => 'Discount price must be less than price',
            //   'categories.required' => 'Please select at least one category',
        ];
    }
}
