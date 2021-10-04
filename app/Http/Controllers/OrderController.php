<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request){
        $time=now()->timestamp;
        foreach ( $request->get("orders") as $order)
            $order['order_history_id']=$time;
        Auth::user()->user_orders()->createMany($request->get("orders"));
    }

}
