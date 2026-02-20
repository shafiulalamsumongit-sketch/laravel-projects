<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'sku' => 'required|string|unique:products,sku',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Error in api call , invalid data data sent',
                'errors' => $validator->errors()->messages(),
            ], 422)
        );

        $errors = $validator->errors();  // Here is your array of errors
        throw new HttpResponseException(
            response()->json(['errors' => $errors], 422)
        );

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['errors' => $errors], 422)
        );
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required, please provide.',
            'sku.required' => 'Product sku is required, please provide.',
            'name.min' => 'Product min is 3 required, please provide.',
            'price.required' => 'Product  Price is required, please provide.',
            'discount_price.lt' => 'Product  Discount price must be less than price',
            'categories.required' => 'Product  Please select at least one category',
        ];
    }
}
