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
