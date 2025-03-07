<?php

namespace App\Http\Controllers\api;

use App\Gender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class GendersController extends Controller
{
    public function all()
    {
        $genders = Gender::all();
        return Response::json($genders);
    }
}
