<?php

namespace App\Http\Controllers;

use App\Country;
use App\City;
use App\Order;
use App\OrderUser;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Category;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index($category = null) {

        if(Gate::allows('userEmailConfirmed', auth()->user())) {
            $categories = Category::children();
            if(empty($category)) {
                $orders = Order::where('status_id','!=',Status::where('name','Закрыт')->first()->id)->orderBy('created_at', 'desc')->paginate(12); // выбираем все заказы, т.к не выбрана категория

            } else {
                $orders = Order::where('status_id','!=',Status::where('name','Закрыт')->first()->id)->where('category_id',$category)->paginate(12); //выбираем заказы указанной категории

                if($orders->isEmpty()) { // если не было найдено заказов по такой категории, ищем все заказы по родительской категори
                    $cat = Category::find($category); // выбираем категорию
                    if(!empty($cat) && empty($cat->parent_id)){ // проверяем, является ли категория родительской
                        $cat = Category::where('parent_id',$cat->id)->get()->pluck('id')->toarray(); // выбираем все дочерние категории
                        $orders = Order::where('status_id','!=',Status::where('name','Закрыт')->first()->id)->whereIn('category_id',$cat)->paginate(12); // выбираем все заказы, которые относятся к родительской и ее дочерним категориям
                    }else {
                        return view('orders.index', ['orders'=>$orders, 'categories'=>$categories])->withErrors(['Такой категории не существует!', 'Выберите уже имеющуюся категорию.']);
                    }
                }

            }

            return view('orders.index', ['orders'=>$orders, 'categories'=>$categories]);
        }

        return redirect()->back()->with('warning', 'Мы сожалеем, но для вас этот раздел закрыт, т.к вы не подтвердили E-mail!');
    }

    public function search(Request $request) {
        if(Gate::allows('userEmailConfirmed', auth()->user())) {
            $categories = Category::children();
            $orders = Order::where('status_id','!=',Status::where('name','Закрыт')->first()->id)->where('name','like','%'.$request->search.'%')->orWhere('description','like','%'.$request->search.'%')->paginate(12); //выбираем все заказы

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
            'end_date' => 'required | date'
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $order = new Order();
        $order->name = $request->name;
        $order->description = $request->description;
        $order->customer_id = $request->user()->id;
        $order->price = $request->price;
        $order->date_end = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
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

    public function destroyOrder(Order $order) {
        $order->usersPivot()->detach();
        $order->delete();
        return redirect()->route('orders')->with('success','Заказ успешно удален');
    }

    public function closeOrder(Request $request, Order $order) {
        $statusOrderClosed = Status::where('name', 'Закрыт')->first()->id;
        $order->status_id = $statusOrderClosed;
        $order->save();
        return redirect()->back()->with('success', 'Заказ успешно закрыт. Не забудьте оставить отзыв мастеру.');
    }

    public function myOrderIndex(Request $request, Order $order) {
        if(Gate::allows('userEmailConfirmed', auth()->user())) {
            $categories = Category::children();
//            if(empty($category)) {
                $orders = Order::where('customer_id',$request->user()->id)->orderBy('created_at', 'desc')->paginate(12); // выбираем все заказы, т.к не выбрана категория

//            } else {
//                $orders = Order::where('customer_id', $request->user()->id)->where('category_id',$category)->paginate(12); //выбираем заказы указанной категории
//
//                if($orders->isEmpty()) { // если не было найдено заказов по такой категории, ищем все заказы по родительской категори
//                    $cat = Category::find($category); // выбираем категорию
//                    if(!empty($cat) && empty($cat->parent_id)){ // проверяем, является ли категория родительской
//                        $cat = Category::where('parent_id',$cat->id)->get()->pluck('id')->toarray(); // выбираем все дочерние категории
//                        $orders = Order::where('customer_id', $request->user()->id)->whereIn('category_id',$cat)->paginate(12); // выбираем все заказы, которые относятся к родительской и ее дочерним категориям
//                    }else {
//                        return view('orders.index', ['orders'=>$orders, 'categories'=>$categories])->withErrors(['Такой категории не существует!', 'Выберите уже имеющуюся категорию.']);
//                    }
//                }
//
//            }

            return view('orders.my-orders', ['orders'=>$orders, 'categories'=>$categories]);
        }

        return redirect()->back()->with('warning', 'Мы сожалеем, но для вас этот раздел закрыт, т.к вы не подтвердили E-mail!');
    }

    public function myOrdersForExecution(Request $request) {
        if(Gate::allows('userEmailConfirmed', auth()->user())) {
            $user = $request->user();
//            $orders = OrderUser::where('user_id', $user->id)->where('status_id', Status::where('name','Принят')->first()->id)->paginate(12);
//            $orders = OrderUser::where('user_id', $user->id)->where('status_id', Status::where('name','Принят')->first()->id)->whereHas('order', function($q){
//                $q->where('status_id', Status::where('name', 'В исполнении')->first()->id);
//            })->paginate(12);
            $orders = OrderUser::where('user_id', $user->id)->where('status_id', Status::where('name','Принят')->first()->id)->whereHas('order', function($q){
                $q->where('status_id',Status::where('name','В исполнении')->first()->id);
            })->paginate(12);
//            dd($orders);
            $categories = Category::children();
//            $orders = Order::where('customer_id',$request->user()->id)->orderBy('created_at', 'desc')->paginate(12);

            return view('orders.my-orders-for-execution', ['orders'=>$orders, 'categories'=>$categories]);
        }

        return redirect()->back()->with('warning', 'Мы сожалеем, но для вас этот раздел закрыт, т.к вы не подтвердили E-mail!');
    }
}
