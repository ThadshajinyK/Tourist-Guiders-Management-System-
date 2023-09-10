<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $places=Place::orderby('id','desc')->get();   
        return view('welcome',compact('places'));
    }
}
