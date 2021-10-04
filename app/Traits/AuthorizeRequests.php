<?php


namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait AuthorizeRequests
{
    private $user_guard="user";
    private $admin_guard="admin";

    public function CheckIfAuthenticated($guard){

        if ( $guard==$this->admin_guard) return true;
        return false;
    }

    public function CheckIfAdminAuthenticated($guard){
        if ( $guard==$this->admin_guard) return true;
        return false;
    }
}
