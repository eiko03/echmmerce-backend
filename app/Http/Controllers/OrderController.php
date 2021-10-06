<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\OrderRejectRequest;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $order_histories=OrderHistory::with('orders')->with('products')->get()->groupBy('order_history_id');
        return response()->json($order_histories);
    }

    public function store(CreateOrderRequest $request){
        $time=intval(intval(now()->timestamp)/rand(9,199));
        foreach ( $orders=$request->get("orders") as $key=>$value)
            $orders[$key]['order_history_id']=$time;
        Auth::user()->user_orders()->createMany($orders);
        return response()->json(["message"=>"Order Successful", "order_id"=>$time],201);
    }

    public function reject(OrderRejectRequest $request){
        $order_histories=OrderHistory::where('order_history_id',$request)->get();
        foreach ($order_histories as $order_history){
//            $stat=$order_history->order_status;
            return response()->json($order_history->order_status);
        }
//        return response()->json($stat);
    }

}
