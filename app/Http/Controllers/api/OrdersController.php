<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\City;
use App\Country;
use App\Order;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function allOrders() {
        $orders = Order::with('country','city','status','category')->get();
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
        $orders = Order::where('name', 'like', "%".$request->search."%")->orWhere('description', 'like', "%".$request->search."%")->with('country','city','status','category')->get();
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
            return Response::json(['success'=>'Заказ успешно удален!']);
        }
        return Response::json(['error'=>'Произошла ошибка во время удаления заказа!']);
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
    return Response::json(['errors'=> 'Список ваших заказов пуст']);
    }
}
