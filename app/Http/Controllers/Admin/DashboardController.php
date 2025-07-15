<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    //

    public function index(){


        return view("admin.dashboard");
    }


    public function login(){

        return view("admin.login");
    }

    public function authenticate(Request $request){

         $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $username = $request->input("username");
        $password = $request->input("password");
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $request->session()->regenerate();
                // return redirect()->intended('admin');

            return redirect()->route("admin");
        }

        return response()->json("there is problae");
    

    }

    public function register(){
        return view("admin.register");
    }

    public function store(Request $request){
        User::create($request->except("_token"));
        return redirect()->route("admin.login");
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/admin/login');
    }







}
