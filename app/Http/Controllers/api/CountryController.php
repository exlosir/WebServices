<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use Illuminate\Support\Facades\Response;


class CountryController extends Controller
{
    public function all()
    {
        $country = Country::all();
        return Response::json($country);
    }
}
