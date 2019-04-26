<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index(Request $request) {
        $user = $request->user();
        $genders = Gender::all();
        $cities = City::all();
        $countries = Country::all();
        return view('profile.index')->with(['user'=>$user,'genders'=>$genders, 'countries'=>$countries, 'cities'=>$cities]);
    }

    public function save(Request $request) {
        $user = $request->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->patronymic = $request->patronymic;
        $user->gender_id = $request->gender;
        $user->country_id = $request->country;
        $user->city_id = $request->city;
        $user->birthday = $request->birthday;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if(!$user->isDirty())
            return redirect()->back()->with('warning', 'Изменения не обнаружены. Данные не обновлены!');
        $user->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены!');

    }

    public function uploadImage(Request $request) {

        $validator = Validator::make($request->all(),[
            'image'=>'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors()->first());

        $image = $request->file('image');
        $imageName = auth()->user()->email.'_'. Str::random().'.'.$image->getClientOriginalExtension();

        $image->move(public_path("/profiles/".auth()->user()->email."/"), $imageName);

        $user = Auth::user();
        $user->image_profile = $imageName;
        $user->save();

        return redirect()->back()->with('success', 'Фотография успешно загружена!');

    }

    public function changePassword(Request $request) {

        $validator = Validator::make($request->all(),[
            'password'=>'required|confirmed|min:6|string'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors()->first());

        $user = auth()->user();
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success', 'Пароль успешно изменен!');
    }

    /*Удаление аккаунта*/

    public function deleteAccount(Request $request) {
          $user = $request->user();

        if ($user->deleteAccount()) {
            return redirect()->to('/logout')->with('success', 'Профиль успешно удален!');
        }

        return redirect()->back()->withErrors('Что-то пошло не так. Профиль не был удален!');

    }


}
