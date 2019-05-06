<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderUser;
use App\Status;
use App\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function create(Request $request, Order $order) {
        return view('orders.feedback.create', ['order'=>$order]);
    }

    public function store(Request $request, Order $order) {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'rating' => 'required|numeric|min:1|max:5'
        ]);
        if($validator->fails()) return redirect()->back()->with($validator->errors());

        $statusAcceptId = Status::where('name', 'Принят')->first()->id; // получаем Id статуса с именем 'Принят'
        $order_user = $order->usersPivot()->where('status_id', $statusAcceptId)->first()->pivot->id; // Получаем id мастера
        $feedback = new Rating(); // создаем новый отзыв
        $feedback->description = $request->description;
        $feedback->order_user =  $order_user;
        $feedback->rating = $request->rating;
        $feedback->timestamps;
        $feedback->save();


        $master = new User();
        foreach($order->users as $item) { // получаем модель мастера
            if($item->id == $order->usersPivot()->where('status_id', $statusAcceptId)->first()->pivot->user_id)
                $master = $item;
        }
        /*Формируем рейтинг самому пользователю по среднему баллу*/
        $arrayOrderUser = DB::table('order_user')->where('user_id', $master->id)->where('status_id', $statusAcceptId)->pluck('id'); // выбираем в связанной таблице order_user все значения, где пользователь был выбран в качестве мастера
        $arrayFeedback = DB::table('rating_order')->whereIn('order_user', $arrayOrderUser)->pluck('rating'); // получаем все отзывы к этому мастеру и выбираем только колонку с рейтингом

        $ratingUser = null;
        foreach($arrayFeedback as $item) { // перебираем все рейтинги
            $ratingUser += $item; // складываем между собой их
        }
        $ratingUser != 0 ? $ratingUser /= $arrayFeedback->count() : $ratingUser = 0;// получаем средний балл и присваиваем пользователю
        $master->rating = $ratingUser;
        $master->save();

        return redirect()->route('orders')->with('success', 'Спасибо, что оставили отзыв ;)');
    }

    public function notResponded(Request $request) {
        $user = auth()->user();
        $ordersUser = $user->orders1;//получаем все заказы текущего пользователя
        $orderMasters = OrderUser::whereIn('order_id', $ordersUser->pluck('id'))->get(); // получаем всех откликнувшихся на заказы
        $orderMasters = $orderMasters->where('status_id',Status::where('name','Принят')->first()->id); // отфильтрованные  значения только принятых к исполнению заказа
        $allFeedbacks = Rating::whereIn('order_user', $orderMasters->pluck('id'))->get();
//            dd($orderMasters->pluck('id'), $allFeedbacks->pluck('order_user'));
        $notFeeds = $orderMasters->pluck('id')->diffKeys($allFeedbacks->pluck('order_user')); // получили количество мастеров, на который текущий пользователь не оставил отзыв
        $orders = OrderUser::whereIn('id',  $notFeeds)->get();
//        dd($orders);
        return view('orders.feedback.notFeeds',['orders'=>$orders]);
    }
}
