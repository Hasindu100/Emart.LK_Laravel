<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function index() {
        session()->put('page-title','Login');
        return view('login');
    }

    function login(Request $req) {
        $user = User::where(['email' => $req->username])->where(['password' => $req->password])->first();
        if(!$user) {
            return redirect('/login')->with('msg','Email or Password does mot match');
        } else {
            $req->session()->put('user-name', $user->name);
            $req->session()->put('user-id', $user->id);
            return redirect('/');
        }
    }

    function logout(Request $req) {
        $req->session()->forget('user-name');
        $req->session()->forget('user-id');

        return redirect('/login');
    }
}
