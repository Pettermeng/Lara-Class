<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    // user login
    public function userLogin(Request $req) {
        $email = $req->email;
        $password = $req->password;

        if(Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $user = Auth::user();
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

            if($token) {
                $result = array(
                    'code' => 200,
                    'message' => 'success',
                    'token'  => $token
                );
            }

            return $result;
        }
    }

    // insert
    public function addNews(Request $req) {
        $title = $req->title;
        $slug  = $this->slug($title);
        $description = $req->description;
        $author = 1;
        $viewer = 0;
        $date   = date('Y-m-d H:i:s');

        $file = $req->file('thumbnail');
        $thumbnail = $this->uploadFile($file);

        $news =  DB::table('news')->insert([
            'title' => $title,
            'slug'  => $slug,
            'author' => $author,
            'viewer' => $viewer,
            'description' => $description,
            'thumbnail' => $thumbnail,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($news) {
            $result = array(
                'code' => 200,
                'message' => 'Post Inserted.'
            );
        }

        return $result;
    }

    // get all
    public function listNews() {
        $news = DB::table('news')
                    ->orderByDesc('id')
                    ->get();
        if($news) {
            $result = array(
                'code'    => 200,
                'message' =>  'success',
                'data'    => $news
            );
        }
        return $result;
    }

    // get one
    public function getNewsByslug($slug) {
        $news = DB::table('news')
                    ->where('slug', $slug)
                    ->get();
        if($news) {
            $result = array(
                'code'    => 200,
                'message' =>  'success',
                'data'    => $news
            );
        }
        return $result;
    }
}
