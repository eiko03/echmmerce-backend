<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateOrderRequest extends FormRequest
{

    public function authorize() {
        if (Auth::guard('user')->check()) return true;
        return false;
    }


    public function rules() {
        return [
            "orders"=>"required|array",
            "orders.*.product_id"=>"sometimes|required|integer",
            "orders.*.qty"=>"sometimes|required|integer"
        ];
    }

    public function attributes() {
        return [
            "orders",
            "orders.*.product_id",
            "orders.*.qty"
        ];
    }

    public function messages() {
        $validation_msg="Something went wrong, please try again";
        return [
            "orders.*"=>$validation_msg,
            "orders.*.product_id.*"=>$validation_msg,
            "orders.*.qty.*"=>$validation_msg
        ];
    }
}
