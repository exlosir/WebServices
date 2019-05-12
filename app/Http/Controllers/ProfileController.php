<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Gender;
use App\Order;
use App\OrderUser;
use App\Role;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index(Request $request) {
        $user = $request->user();
        $genders = Gender::all();
        $countOrders = Order::where('customer_id', $user->id)->get()->count();
        $countDoneOrders = OrderUser::where('user_id', $user->id)->where('status_id',Status::where('name', 'Принят')->first()->id)->get()->count();
        return view('profile.index')->with(['user'=>$user,'genders'=>$genders, 'countOrders'=>$countOrders, 'countDoneOrders'=>$countDoneOrders]);
    }

//    public function getCities(Country $country) {
//        $cities = City::where('country_id',$country->id)->get();
//        return $cities;
//    }

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

    public function addRole(Request $request) {

        $user = User::find($request->user()->id);
        $role = Role::where('name', $request->roleName)->get();

        if(!$user->roles()->get()->contains($role->first()->id)) {
            $user->roles()->attach($role);
            return json_encode(true);
        }

        return json_encode(false);

    }

    public function delRole(Request $request) {
        $user = User::find($request->user()->id);
        $role = Role::where('name', $request->roleName)->get();

        if($user->roles()->get()->contains($role->first()->id)) {
            $user->roles()->detach($role);
            return json_encode(true);
        }

        return json_encode(false);

    }

    public function getRole(Request $request) {
        $user = User::find($request->user()->id);
        $role = Role::where('name', $request->roleName)->get();

        return json_encode($user->roles()->get()->contains($role->first()->id));
    }

    public function getCountries() {
        return Response::json($categories = Country::all());
    }

    public function getCities($id) {
        $cities = City::where('country_id', $id)->get();
        return Response::json($cities);
    }

    public function getCountryCity() {
        $user = auth()->user();
        return Response::json(['country'=>$user->country ? $user->country->name : null, 'city'=>$user->city ? $user->city->name : null]);
    }


}
