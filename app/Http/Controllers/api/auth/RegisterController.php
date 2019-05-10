<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'login' => 'required',
            'password' => 'required|confirmed'
        ]);
        if ($validator->fails()) return response()->json($validator->errors()); // если не прошел валидацию, выдать ошибку
        $user = new User();
        $user->email = $request->email;
        $user->login = $request->login;
        $user->password = bcrypt($request->password);
        $user->api_token = Str::random();
        $user->save();
        $user = User::find($user->id);
        return Response::json($user)->setStatusCode(200, 'Succsessful creating account');
    }
}
