<?php

namespace App\Http\Controllers\Backend;

use App\Place;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    public function index()
    {
        $place=Place::orderby('id','desc')->get();        
        return view('backend.place.index',['places'=>$place]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.place.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->all()){

            $pro=new Place;
            $pro->place=$request->place;
            $pro->guider=strtoupper($request->guider);
            $pro->description=$request->description;
            $pro->district=$request->district;
            $pro->address=$request->address;

            if($file=$request->file('image')){
                $extention=$file->getClientOriginalExtension();
                $filename=time().".".$extention;
                $file->move('images/places',$filename);
                $pro->image=$filename; 
            }
            $pro->save();             

            return redirect('/place')->with('success', 'Product Added Successfully');   
        }
        else{
            return back()->with('error','Please fill all');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guiders = Place::find($id)->guider;
        $guider=explode(',',$guiders);
        $place=Place::findOrFail($id);
        return view('backend.place.show',compact('place','guider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place=Place::find($id);
        return view('backend.place.edit',compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if($request->all()){

            $pro=Place::find($id);
            $pro->place=$request->place;
            $pro->guider=strtoupper($request->guider);
            $pro->description=$request->description;
            $pro->district=$request->district;
            $pro->address=$request->address;

            if($file=$request->file('image')){
                $extention=$file->getClientOriginalExtension();
                $filename=time().".".$extention;
                $file->move('images/places',$filename);
                $pro->image=$filename; 
            }
            $pro->update();             

            return redirect('/place')->with('success', 'Product Update Successfully');   
        }
        else{
            return back()->with('error','Please fill all');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place=Place::findOrFail($id)->delete();        
        return redirect('/place')->with('success','Successfully Deleted'); 
    }
}
