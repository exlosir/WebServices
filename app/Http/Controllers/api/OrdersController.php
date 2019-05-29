<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\City;
use App\Country;
use App\Order;
use App\OrderUser;
use App\Rating;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function allOrders() {
        $orders = Order::where('status_id', '!=', Status::where('name', 'Закрыт')->first()->id)->with('country','city','status','category')->orderBy('created_at', 'desc')->get();
//        $orders = new Collection();
//        foreach(Order::all() as $order) {
//            $order->status_id = $order->status()->first()->name;
//            $order->country_id = $order->country()->first()->name;
//            $order->city_id = $order->city()->first()->name;
//            $order->category_id = $order->category()->first()->name;
//            $orders->push($order);
//        }

        return Response::json($orders)->setStatusCode(200);
    }

    public function searchOrders(Request $request) {
        // передать параметр search || POST запрос
        $orders = Order::where('status_id', '!=', Status::where('name', 'Закрыт')->first()->id)->where('name', 'like', "%".$request->search."%")->orWhere('description', 'like', "%".$request->search."%")->with('country','city','status','category')->get();
        return Response::json($orders);
    }

    public function addOrder(){
        $categories = Category::all();
        $countries = Country::all();
        $cities = City::all();

        return Response::json(['categories'=>$categories, 'countries'=>$countries, 'cities'=>$cities]);
    }

    public function storeOrder(Request $request) {
        //POST запрос
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'country' => 'required',
            'city' => 'required',
            'date_end' => 'required'
        ]);

        if($validator->fails()) return Response::json($validator->errors());

        $order = new Order();
        $order->name = $request->name;
        $order->description = $request->description;
        $order->customer_id = $request->user_id;
        $order->price = $request->price;
        $order->date_end = \Carbon\Carbon::parse($request->date_end)->format('Y-m-d H:i:s');
        $order->status_id = Status::where('name','Открыт')->get()->first()->id;
        $order->category_id = Category::where('name',$request->category)->first()->id;
        $order->country_id = Country::where('name',$request->country)->first()->id;
        $order->city_id = City::where('name',$request->city)->first()->id;
        $order->street = $request->street;
        $order->house = $request->house;
        $order->building = $request->building;
        $order->apartment = $request->apartment;
        $order->timestamps;
        $order->save();

        return Response::json('Заказ успешно добавлен');
    }

    public function destroyOrder(Request $request, $id) {
        $order = Order::find($id);
        if($order->user->id == $request->user_id){
            $order->delete();
            return Response::json('Заказ успешно удален!');
        }
        return Response::json('Произошла ошибка во время удаления заказа!');
    }

    public function aboutOrder(Request $request, $id) {
        $orders = Order::where('id',$id)->with('country','city','status','category', 'user')->get();
        return Response::json($orders)->setStatusCode(200);
    }

    public function myOrders($id) {
/*$id - ид пользователя авторизованного*/
    $orders = Order::where('customer_id',$id)->with('country','city', 'status', 'user')->get();
    if(!$orders->isEmpty())
        return Response::json($orders);
    return Response::json('Список ваших заказов пуст');
    }

    public function myOrdersForExecution(Request $request) {
        /* @params
         * user_id
         * */
        $ord = new Collection();
        $user = User::find($request->user_id);
        $orders = OrderUser::where('user_id', $user->id)->where('status_id', Status::where('name','Принят')->first()->id)->whereHas('order', function($q){
            $q->where('status_id',Status::where('name','В исполнении')->first()->id);
        })->with('order', 'order.city', 'order.country', 'order.category', 'order.status')->get();
        foreach ($orders as $order) {
            $ord->push($order->order);
        }

        return Response::json($ord);
    }

    public function closeAndFeedback(Request $request) {
        /*
         * order_id
         * rating
         * description
         * */
        $statusOrderClosed = Status::where('name', 'Закрыт')->first()->id;
        $order = Order::find($request->order_id);
        $order->status_id = $statusOrderClosed;
        $order->save();

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

        return Response::json('Спасибо что оставили отзыв');
    }
}
