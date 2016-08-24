<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Mockery\CountValidator\Exception;
use App\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

//        dd($request->all());

        $rules = [
            'name' => 'required|min:6|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect('/register')->withErrors($validation)->withInput();
        }

        $confirmation_code = str_random(32);


        User::create(array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirmation_code' => $confirmation_code
        ));


        Mail::send('email.verify', ['request' => $request, 'confirmation_code' => $confirmation_code], function ($mes) use ($request) {

            $mes->from('spdoan0111@gmail.com', 'Support');

            $mes->to($request->email, $request->name)->subject('Verify you email');


        });

//        $request->session()->flash('message', 'Thanks for signing up! Pls check ur email!');

        return view('register_done')->with('message','Register is DOne!!');

    }


    public function confirm(Request $request, $confirmationCode)
    {
//        dd($confirmationCode);
        if (!$confirmationCode) {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::where('confirmation_code',$confirmationCode)->first();

        if (!$user) {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

//        session()->

       return redirect('/login')->with('message',"Register is DOne!!!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
