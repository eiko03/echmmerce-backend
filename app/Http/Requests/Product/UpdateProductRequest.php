<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guard('admin')->check()) return true;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|between:2,100',
            'description' => 'sometimes|required|string|max:1000',
            'price' => 'sometimes|required|numeric|not_in:0|min:0',
            'qty' => 'sometimes|required|integer|min:0',
            'image' => 'sometimes|string',
        ];
    }
}
