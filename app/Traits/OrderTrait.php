<?php


namespace App\Traits;


use Illuminate\Support\Facades\Auth;

trait OrderTrait
{


    public function ValidateOrderUpdate($order_history){

    }

    public function UpdateOrder($request_orders,$OrderId){
        foreach ( $orders=$request_orders as $key=>$value)
            $orders[$key]['order_history_id']=$OrderId;
        Auth::user()->user_orders()->createMany($orders);
    }

}
