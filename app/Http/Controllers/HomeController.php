<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request) {
       // dd($request->all());
        $users=Staff::where('ssn',$request->ssn)->where('pwd',$request->password)->get();
       // dd($users);
        if (count($users))
        {

            session(['id' => $users[0]->id]);
            return \redirect()->route('home');
        } else {

            Session::flash ( 'message', "Invalid Credentials , Please try again." );
            return Redirect::back ();
        }
    }

    public function index()
    {
        return view('home');
    }
}
