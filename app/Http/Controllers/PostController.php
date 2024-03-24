<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function listPost() {
        return view('list-post');
    }

    public function postDetail($id) {
        return view('post-detail',[
            'id' => $id
        ]);
    }

    // Add Post
    public function addPost() {
        return view('add-post');
    }
    public function addPostSubmit(Request $request) {
        // $name = $request->username;
        // return $name;

        $file = $request->file('profile');
        $profile = rand(1,999).'-'.$file->getClientOriginalName();
        $path    = 'uploads';
        $file->move($path, $profile);

        return redirect('/add-post');

    }

    //Master Template
    public function Home() {
        return view('home');
    }

    public function About() {
        return view('about');
    }

 }
