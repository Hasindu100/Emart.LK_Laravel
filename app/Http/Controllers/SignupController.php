<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    //
    public function index() {
        session()->put('page-title','SignUp');
        return view('signup');
    }

    public function register(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;

        $user = new User();
        $user->name = $username;
        $user->password = $password;
        $user->email = $email;
        
        $created = $user->save();

        if($created) {
            return redirect('/login')->with('msg','Registered Successfully. Please Login here...');
        }
    }
}
