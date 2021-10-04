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
        foreach ( $orders=$request->get("orders") as $key=>$value)
            $orders[$key]['order_history_id']=$time;
        Auth::user()->user_orders()->createMany($orders);
        return response()->json($orders);
    }

}
