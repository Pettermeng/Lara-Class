<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function listPost() {

        $post = DB::table('post')
                    ->orderByDesc('id')
                    ->get();
        
        return view('list-post',[
            'post' => $post
        ]);
    }

    public function postDetail($id) {

        $post = DB::table('post')
                    ->where('id', $id)
                    ->get();

        return view('post-detail',[
            'post' => $post
        ]);
    }

    // Add Post
    public function addPost() {
        return view('add-post');
    }
    public function addPostSubmit(Request $request) {

        $title = $request->title;
        $description = $request->description;

        $file    = $request->file('thumbnail');
        $thumbnail = rand(1,999).'-'.$file->getClientOriginalName();
        $path    = 'uploads';
        $file->move($path, $thumbnail);

        //Prepare Insert to DB
        $post = DB::table('post')->insert([
                        'title'       => $title,
                        'thumbnail'   => $thumbnail,
                        'description' => $description
                    ]);

        return redirect('/add-post');

    }

    //action update
    public function postUpdate($id) {
        $post = DB::table('post')
                    // ->where('id', $id)
                    // ->get();
                    ->find($id);
        return view('post-update',[
            'post' => $post
        ]);
    }

    public function postUpdateSubmit(Request $request) {
        $id          = $request->id;
        $title       = $request->title;
        $description = $request->description;

        if(!empty( $request->file('thumbnail'))) {
            $file = $request->file('thumbnail');
            $thumbnail = $this->moveUploadFile($file);
        }
        else {
            $thumbnail = $request->old_thumbnail;
        }

        //prepare update
        $post = DB::table('post')
                    ->where('id', $id)
                    ->update([
                        'title'       => $title,
                        'thumbnail'   => $thumbnail,
                        'description' => $description
                    ]);

        if($post) {
            return redirect('/post')->with('message', 'Post Updated');
        }

    }

    // action remove
    public function postRemove($id) {
        $post = DB::table('post')
                    // ->where('id', $id)
                    ->delete($id);
         
        if($post) {
            return redirect('/post')->with('message', 'Post Deleted');
        }            
                    
    }

    //Master Template
    public function Home() {
        return view('home');
    }

    public function About() {
        return view('about');
    }

    // User Login & Register
    public function userRegister()
    {
        return view('register');
    }

    public function userRegisterSubmit(Request $request) {
        $name     = $request->name;
        $email    = $request->email;
        $password = Hash::make($request->password);
        $date     = date('Y-m-d H:i:s');

        // prepare insert to DB
        $user = DB::table('users')->insert([
            'name'       => $name,
            'email'      => $email,
            'password'   => $password,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        if($user) {
            return redirect('login');
        }
    }

    public function userLogin() {
        return view('login');
    }

    public function userLoginSubmit(Request $request) {
        $name      = $request->name;
        $password  = $request->password;

        if(Auth::attempt([
            'name'     => $name,
            'password' => $password
        ])) {
            return redirect('add-post');
        }
        else {
            return redirect('login')->with('message', 'Invalid User');
        }

    }

 }
