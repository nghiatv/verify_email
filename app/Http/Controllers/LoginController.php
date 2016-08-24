<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class LoginController extends Controller
{
    //


    public function index()
    {

        return view('auth.login');


    }


    public function store(Request $request)
    {

        $rule = array(
            'email' => 'required|exists:users',
            'password' => 'required'
        );


        $validation = Validator::make($request->all(), $rule);


        if ($validation->fails()) {
            return redirect('/login')->withErrors($validation)->withInput();
        }


//        dd($request->all());
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
            'confirmed' => 1
        );


        if (! Auth::attempt($credentials)) {
            return redirect('/login')->withInput()->withErrors(['credentials' => 'We were unable to sign you in.']);
        }

//        $request->session()->flash('message', 'Wellcome!');
        return redirect('/home')->with('message','Welcome!');
    }


    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
