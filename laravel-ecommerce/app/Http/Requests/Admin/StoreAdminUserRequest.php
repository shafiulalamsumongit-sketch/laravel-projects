<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class StoreAdminUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // return true;
        // return $this->user()->can('update', $post);
        return Gate::forUser(auth('admin')->user())->allows('super-admin-access');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Admin name is required, please provide.',
            'email.required' => 'Admin email is required, please provide.',
            'password.required' => 'Admin password is required, please provide.',
            'role.required' => 'Admin role is required, please provide.'
        ];
    }
}
