<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Portfolio;

class UserController extends Controller
{
    public function user(Request $request, $id) {
        $user = User::find($id);
        $elements = Portfolio::where('user_id',$id)->take(6)->get();
        return view('user.page', compact(['user', 'elements']));
    }
}
