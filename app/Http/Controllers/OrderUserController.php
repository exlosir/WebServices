<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderUserController extends Controller
{
    public function getUsers() {
        $order = Order::find(1);
        dd($order->getMastersCount());
    }
}
