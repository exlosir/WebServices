<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Status;
use App\User;

class OrderUserController extends Controller
{
    public function add(Request $request, $order,$user) {
        $order = Order::find($order);
        $user = User::find($user);

        $statusId = Status::where('name','В ожидании')->get()->first()->id;
        $created_updated_at = \Carbon\Carbon::now();
//        dd($order, $user);
        $order->users()->attach($user,array('status_id'=>$statusId, 'created_at'=>$created_updated_at, 'updated_at'=>$created_updated_at));
        return redirect()->back()->with('success', 'Ваш предложение принято! Ожидайте ответа Заказчика!');
    }

    public function getUsers() {
        $order = Order::find(1);
        dd($order->getMastersCount());
    }
}
