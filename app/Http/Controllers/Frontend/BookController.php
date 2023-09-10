<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Place;
use App\Book;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index(Request $request){
       $place = Place::find($request->place_id);
       $guider = DB::table('guiders')->where('name',$request->guider)->first();
        $book = [
            'customer_id' => Auth::user()->id,
            'guider' => $request->guider,
            'days' => $request->days,
            'fees' =>($request->days*$guider->fees),
        ];

        return view('frontend.book.index',compact('place'))->with($book);
    }

    public function confirm(Request $request){

        $place=Place::find($request->place);

        $book = new Book;
        $book->payment=$request->payment_method;
        $book->fees=$request->fees;
        $book->days=$request->days;
        $book->guider=$request->guider;
        $book->place=$place->place;
        $book->date=$request->date;
        $book->customer=Auth::user()->name;
        $book->save();

        return view('home',compact('place'));
    }
}
