<?php

namespace App\Http\Controllers\Frontend;
use App\Place;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index($id){
        $place = Place::find($id);
        $guiders=Place::find($id)->guider;
        $guider= explode(',',$guiders);

        return view('frontend.place.index',compact('place','guider'));
    }
}
