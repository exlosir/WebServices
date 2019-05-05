<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Status;
use App\User;
use Illuminate\Support\Collection;

class OrderUserController extends Controller
{
    public function add(Request $request, $order,$user) {
        $order = Order::find($order);
        $user = User::find($user);

        $statusId = Status::where('name','В ожидании')->get()->first()->id;
        $created_updated_at = \Carbon\Carbon::now();

        $order->users()->attach($user,array('status_id'=>$statusId, 'created_at'=>$created_updated_at, 'updated_at'=>$created_updated_at));
        return redirect()->back()->with('success', 'Ваш предложение принято! Ожидайте ответа Заказчика!');
    }

    public function acceptMaster(Request $request, Order $order, User $master) {
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
        return redirect()->route('user-page', $master->id)->with('success', 'Вы выбрали специалиста. Пожалуйста, уведомите его о свего решении! ');
    }

    public function getUsers() {
        $order = Order::find(1);
        dd($order->getMastersCount());
    }
}
