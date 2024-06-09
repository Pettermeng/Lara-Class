<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Sign In
    public function Signin() {
        return view('backend.login');
    }

    public function SigninSubmit(Request $request) {
        $name     = $request->name_email;
        $password = $request->password;

        //validate user auth
        if(Auth::attempt(array(
            'name'   => $name,
            'password'=> $password
        ), $request->remember)) {
            return redirect('/admin');
        }
        else {
            return redirect('/signin')->with('message_fail','Invalid User!');
        }
    }

    // Sign Up
    public function Signup() {
        return view('backend.register');
    }

    public function SignupSubmit(Request $request) {
        $name     = $request->name;
        $email    = $request->email;
        $password = Hash::make($request->password);

        //Check existing user in DB
        $existUser = DB::table('users')->where(['name' => $name])->get();
        if(count($existUser) == 0) {
            $file    = $request->file('profile');
            $profile = $this->uploadFile($file);

            $date    = date('Y-m-d h:i:s');

            //insert to DB
            $user = DB::table('users')->insert([
                'name'       => $name,
                'email'      => $email,
                'password'   => $password,
                'profile'    => $profile,
                'created_at' => $date,
                'updated_at' => $date
            ]);

            if($user) {
                return redirect('/signin')->with('message','Account register success.');
            }
            else {
                return redirect('/signup')->with('message','Account register fail.');
            }
        }
        else {
            return redirect('/signup')->with('message_exist_user','Account exist,Please try another username.');
        }

    }

    //Logout
    public function SignOut() {
        Auth::logout();
        return redirect('/signin')->with('message_logout','User have been signout.');
    }
}
