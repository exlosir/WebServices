<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) return response()->json($validator->errors()); // если не прошел валидацию, выдать ошибку

        $userHashedPassword = User::where('login', $request->login)->first()->password;
        if (Hash::check($request->password, $userHashedPassword)) {
            $user = User::where('login', $request->login)->with('city.name')->first();
            // dd($user);
            if (!is_null($user)) {
                $user->update(['api_token' => Str::random()]);
                return Response::json($user)->setStatusCode(200, 'Successful authorization');
            }
        }


        return Response::json('Неверный логин или пароль.')->setStatusCode(400);
    }
}
