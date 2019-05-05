<?php

namespace App\Http\Controllers;

use App\Mail\EmailConfirmation;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfirmationEmailController extends Controller
{
    public function request(Request $request)
    {
        $user = $request->user();
        return view('profile.request-confirmation-email', compact('user'));
    }

    public function sendEmail(Request $request) {

        $token = $request->user()->getEmailConfirmationToken();


//        Mail::to($request->user()->email)->send(new EmailConfirmation($request->user(), $token));
        Mail::to($request->user()->email)->send(new EmailConfirmation($request->user(), $token));
        return redirect()->route('profile')->with('success', 'На вашу почту было отправлено письмо для подтверждения E-mail!');

    }

    public function confirm(User $user, $token) {
       $user =  User::where('email', $user->email)->where('confirmed_email_token', $token)->first();

        if(! $user) {
            return redirect()->route('request-confirmation-email', $user)->with('warning', 'Ссылка стала недействительной! Пожалуйста, попробуйте снова.');
        }

        $user->confirmEmail();
        $role = Role::where('name', 'Заказчик')->get();
        $user->roles()->attach($role);

        return redirect()->route('profile')->with('success', 'Ваш почтовый адрес успешно подтвержден. Для вас стали доступны заказы!');

    }
}


