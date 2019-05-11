<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderUser;
use App\Status;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $countUsers = User::all()->count();
        $countOrders = Order::all()->count();
        $countDoneOrders = OrderUser::where('status_id', Status::where('name', 'Закрыт')->first()->id)->get()->count();
    	return view('admin.index', compact(['countUsers', 'countOrders', 'countDoneOrders']));
    }
}
