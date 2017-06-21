<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    public function Regions(){
        $data = Region::all();
        return json_decode($data);
    }
}
