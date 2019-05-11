<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderUser;
use App\Status;
use Illuminate\Http\Request;
use App\User;
use App\Portfolio;
use App\Rating;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function user(Request $request, $id) {
        $user = User::find($id);
        $elements = Portfolio::where('user_id',$id)->take(6)->get();
        $orderIds = DB::table('order_user')->where('user_id', $user->id)->get()->pluck('id')->toArray();
        $feedbacks = Rating::whereIn('order_user', $orderIds)->get();
        $countOrders = Order::where('customer_id', $user->id)->get()->count();
        $countDoneOrders = OrderUser::where('user_id', $user->id)->where('status_id',Status::where('name', 'Принят')->first()->id)->get()->count();
        return view('user.page', compact(['user', 'elements', 'feedbacks', 'countOrders', 'countDoneOrders']));
    }

    public function extendUserPortfolio(Request $request, $id) {
        $user = User::find($id);
        $elements = Portfolio::where('user_id',$id)->paginate(12);
        return view('user.extend-portfolio', compact(['user', 'elements']));
    }

    public function addRole(Request $request, $idRole) {
        $user = User::find($request->user()->id);
        if($request->input('method') == 'attach') {
            $user->attach($idRole);
        }else {
            $user->detach($idRole);
        }
    }
}
