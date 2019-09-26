<?php

namespace App\Http\Controllers;
use App\Address;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index() {
        $addresses = Address::with('provider')->get();
        return view('pages.map')->with('addresses', $addresses);
    }
}
