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
}
