<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function Countries(){
        $data = Country::all();
        return json_decode($data);
    }
}
