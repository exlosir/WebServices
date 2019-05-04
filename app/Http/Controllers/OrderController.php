<?php

namespace App\Http\Controllers;

use App\Country;
use App\City;
use App\Order;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Category;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index($category = null) {

        if(Gate::allows('userEmailConfirmed', auth()->user())) {
            if(empty($category)) {
                $orders = Order::orderBy('created_at', 'desc')->paginate(12); // выбираем все заказы, т.к не выбрана категория
            } else {
                $orders = Order::where('category_id',$category)->paginate(12); //выбираем заказы указанной категории
                if($orders->isEmpty()) { // если не было найдено заказов по такой категории, ищем все заказы по родительской категории
                    $cat = Category::find($category); // выбираем категорию
                    if($cat->parent_id == null){ // проверяем, является ли категория родительской
                        $cat = Category::where('parent_id',$cat->id)->get(12)->pluck('id')->toarray(); // выбираем все дочерние категории
                        $orders = Order::whereIn('category_id',$cat)->paginate(12); // выбираем все заказы, которые относятся к родительской и ее дочерним категориям
                    }
                }

            }
            $categories = Category::children();

            return view('orders.index', ['orders'=>$orders, 'categories'=>$categories]);
        }

        return redirect()->back()->with('warning', 'Мы сожалеем, но для вас этот раздел закрыт, т.к вы не подтвердили E-mail!');
    }

    public function add() {
        $categories = Category::children(null);
        $countries = Country::all();
        $cities = City::all();
        return view('orders.add', ['categories'=>$categories, 'countries'=>$countries, 'cities'=>$cities]);
    }

    public function save(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors('Заполнены не все поля');
        }

        $order = new Order();
        $order->name = $request->name;
        $order->description = $request->description;
        $order->customer_id = $request->user()->id;
        $order->price = $request->price;
        $order->date_end = \Carbon\Carbon::parse($request->date_end)->format('Y-m-d\TH:i');
        $order->status_id = Status::where('name','Открыт')->get()->first()->id;
        $order->category_id = $request->category;
        $order->country_id = $request->country;
        $order->city_id = $request->city;
        $order->street = $request->street;
        $order->house = $request->house;
        $order->building = $request->building;
        $order->apartment = $request->apartment;
        $order->timestamps;
        $order->save();

        return redirect()->route('orders')->with('success','Заказа успешно добавлен!');

    }

    public function indexMore($orderId) {
        if(Gate::allows('userEmailConfirmed', auth()->user())) {
            $order = Order::find($orderId);

            return view('orders.more', ['order' => $order]);
        } else {
            return redirect()->back()->with('warning', 'Мы сожалеем, но для вас этот раздел закрыт, т.к вы не подтвердили E-mail!');
        }
    }
}
