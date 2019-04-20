<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{

    public function index() {

        if(Gate::allows('userEmailConfirmed', auth()->user())) {
            return "Хоп хей лалалей!";
        }

        return "Мы сожалеем, но для вас этот раздел закрыт, т.к вы не подтвердили E-mail!";

    }

}
