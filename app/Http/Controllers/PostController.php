<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('post-detail',[
            'id' => $id
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

    //Master Template
    public function Home() {
        return view('home');
    }

    public function About() {
        return view('about');
    }

 }
