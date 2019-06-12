<?php

namespace App\Http\Controllers\api;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CityController extends Controller
{
    public function all() {
        $cities = City::all();

        return Response::json($cities);
    }
}
