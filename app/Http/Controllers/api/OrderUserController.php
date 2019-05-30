<?php

namespace App\Http\Controllers\api;

use App\Order;
use App\OrderUser;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class OrderUserController extends Controller
{
    public function getRespondedUser($id) {
        /* вставить в url
         * id заказа
         * */
        $order = Order::find($id)->usersPivot;
        $order1 = Order::find($id)->users;
        foreach ($order1 as $index => $item) {
            $item->status_master = $order[$index]->pivot->statuses_name;
        }
        return Response::json($order1);
    }

    public function add(Request $request) {
        /* @params
         * user_id
         * order_id
         * */
        $order = Order::find($request->order_id);
        $user = User::find($request->user_id);

        $statusId = Status::where('name','В ожидании')->get()->first()->id;
        $created_updated_at = \Carbon\Carbon::now();

        $order->users()->attach($user,array('status_id'=>$statusId, 'created_at'=>$created_updated_at, 'updated_at'=>$created_updated_at));
        return Response::json('Ваш предложение принято! Ожидайте ответа Заказчика!');
    }
}
