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
    public function getRespondedUser($id)
    {
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

    public function add(Request $request)
    {
        /* @params
         * user_id
         * order_id
         * */
        $exists = OrderUser::where('user_id', $request->user_id)->where('order_id', $request->order_id)->get();
        if (!$exists->isEmpty()) {
            $order = Order::find($request->order_id);
            $user = User::find($request->user_id);

            $statusId = Status::where('name', 'В ожидании')->get()->first()->id;
            $created_updated_at = \Carbon\Carbon::now();

            $order->users()->attach($user, array('status_id' => $statusId, 'created_at' => $created_updated_at, 'updated_at' => $created_updated_at));
            return Response::json(true);
        }
        return Response::json(false);
    }

    public function executeOrderMaster(Request $request)
    {
        /* @params
         * order_id
         * */
        $order = OrderUser::where('order_id', $request->order_id)->where('status_id', Status::where('name', 'Принят')->first()->id)->whereHas('order', function ($q) {
            $q->where('status_id', Status::where('name', 'В исполнении')->first()->id);
        })->get();
        if (!$order->isEmpty()) {
            $user = User::find($order->first()->user_id);
            return Response::json($user);
        }
        return Response::json(false);
    }

    public function acceptMaster(Request $request,$order_id, $master_id) {
        /* @params
         *  вставить в url
         *  order id
         *  master id (id пользователя в таблице users, который откликнулся на заказ)
         * */
        $order = Order::find($order_id);
        $master = User::find($master_id);

        $statusAcceptId = Status::where('name', 'Принят')->first()->id;
        $statusWaitId = Status::where('name', 'В ожидании')->first()->id;
        $statusDeclineId = Status::where('name', 'Отклонен')->first()->id;

        $currUser = $order->usersPivot()->where('user_id', $master->id)->get(); //находим выбранного пользователя
        $currUser->first()->pivot->status_id = $statusAcceptId; //изменяем его статус в Pivot таблице
        $currUser->first()->pivot->save(); // сохраняем
        /*Отклоняем всех, кроме выбранного пользователя*/
        foreach($order->usersPivot as $user) { // перебираем всех пользователей
            if($user->pivot->status_id == $statusWaitId){ // проверяем их статус = в ожидании
                $user->pivot->status_id = $statusDeclineId; // меняем и сохраняем
                $user->pivot->save();
            }
        }
        /*Меняем статус заказа на 'В исполнении' */
        $order->status_id = Status::where('name', 'В исполнении')->first()->id;
        $order->save();
        return Response::json(true);
    }
}
