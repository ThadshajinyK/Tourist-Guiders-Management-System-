<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Redirect;

class RegisterController extends Controller
{
    
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::USER;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function ShowRegisterForm(){
        return view('auth.user.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'fname' => ['required', 'string', 'max:255'],
           // 'lname' => ['required', 'string', 'max:255'],
           'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

      /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
  

    public function Register(Request $request){
        $this->validator($request->all())->validate();
        $user = User::create([
            //'fname' => $request->fname,
           // 'lname' => $request->lname,
           'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 
        $this->guard()->login($user);
        return Redirect::back()->with('success','You are successfuly Create your Account'); 
       // echo $request->lname;
    }


}
