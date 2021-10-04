<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request){
        Auth::user()->user_orders()->create();
    }

}
