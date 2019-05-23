<?php

namespace App\Http\Controllers\api;

use App\City;
use App\Country;
use App\Gender;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index($id) { /*Отображение страницы профиля*/
        $countries = Country::all();
        return Response::json(User::where('id',$id)->with('city','country', 'gender')->get());
    }

    public function getCities(Request $request) {
        return Response::json(City::where('country_id', $request->country_id)->get());
    }

    public function update(Request $request, $id) {
        /* first_name
         * last_name
         * patronymic
         * gender
         * country
         * city
         * birthday
         * email
         * phone_number
         * */
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->patronymic = $request->patronymic;
        $user->gender_id = Gender::where('name',$request->gender)->first()->id;
        $user->country_id = Country::where('name',$request->country)->first()->id;
        $user->city_id = City::where('name',$request->city)->first()->id;;
        $user->birthday = $request->birthday;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if(!$user->isDirty())
            return Response::json(['error', 'Изменения не были обнаружены']);
        $user->save();

        return Response::json(['success'=>'Данные успешно сохранены']);
    }

    public function changePassword(Request $request) {
        /*password
        password_confirmation
        */
        $validator = Validator::make($request->all(),[
            'password'=>'required|confirmed|min:6|string'
        ]);

        if($validator->fails())
            return Response::json($validator->errors())->setStatusCode(400);

        $user = auth()->user();
        $user->password = Hash::make($request->password);

        $user->save();

        return Response::json(['success'=>'Пароль успешно изменен'])->setStatusCode(200);
    }

    public function destroy($id) {
        $user = User::find($id);
        if(!is_null($user)){
            if ($user->delete()) {
                return Response::json(['success'=>'Профиль успешно удален!'])->setStatusCode(200);
            }
        }
        return Response::json(['error'=>'Произошла ошибка. Профиль не был удален!'])->setStatusCode(400);
    }

    public function uploadImageProfile (Request $request) {
        $user = User::where('api_token',$request->api_token)->first();
        $image = $request->file('image');
        $imageName = $user->email.'_'. Str::random().'.'.$image->getClientOriginalExtension();

        $image->move(public_path("/profiles/".$user->email."/"), $imageName);

        return Response::json("Фотография успешно сохранена!");
    }
}
