<?php

namespace App\Http\Controllers\Backend;

use App\Guider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuiderController extends Controller
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
        $guider=Guider::orderby('id','desc')->get();        
        return view('backend.guider.index',['guider'=>$guider]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.guider.create');
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

            $pro=new Guider;
            $pro->name=strtoupper($request->name);
            $pro->phone=$request->phone;
            $pro->fees=$request->fees;
            $pro->save();             

            return redirect('/guide')->with('success', 'Product Added Successfully');   
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
        $guider=Guider::findOrFail($id);
        return view('backend.guider.show',compact('guider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place=Guider::find($id);
        return view('backend.guider.edit',compact('place'));
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

            $pro=Guider::find($id);
            $pro->name=strtoupper($request->name);
            $pro->phone=$request->phone;
            $pro->fees=$request->fees;
            $pro->update();             

            return redirect('/guide')->with('success', 'Product Added Successfully');   
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
        $place=Guider::findOrFail($id)->delete();        
        return redirect('/guide')->with('guide','Successfully Deleted'); 
    }
}
