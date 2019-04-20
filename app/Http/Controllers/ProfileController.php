<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Gender;
use Illuminate\Http\Request;

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
        if($user->first_name != $request->first_name)
            $user->first_name = $request->first_name;
        elseif($user->last_name != $request->last_name)
            $user->last_name = $request->last_name;
        elseif($user->patronymic != $request->patronymic)
            $user->patronymic = $request->patronymic;
        elseif(is_null($user->gender))
            $user->gender_id = $request->gender;
        elseif($user->gender->id != $request->gender)
            $user->gender_id = $request->gender;
        elseif(is_null($user->country))
            $user->country_id = $request->country;
        elseif($user->country->id != $request->country)
            $user->country_id = $request->country;
        elseif(is_null($user->city))
            $user->city_id = $request->city;
        elseif($user->city->id != $request->city)
            $user->city_id = $request->city;
        elseif($user->birthday != $request->birthday)
            $user->birthday = $request->birthday;
        elseif($user->email != $request->email)
            $user->email = $request->email;
        elseif($user->phone_number != $request->phone_number)
            $user->phone_number = $request->phone_number;
        else
            return redirect()->back()->with('warning', 'Изменения не обнаружены. Данные не обновлены!');

        $user->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены!');

    }
}
