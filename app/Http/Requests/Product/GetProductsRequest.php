<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetProductsRequest extends FormRequest
{

    public function authorize()
    {
        if (auth()->user()) return true;
        return false;
    }


    public function rules()
    {
        return [
            'sort_by'=>Rule::in(['ASC','DESC']),
            'search_by'=>'sometimes|required|string',
        ];
    }
}
