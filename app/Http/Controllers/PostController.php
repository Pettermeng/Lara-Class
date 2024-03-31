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

 }
