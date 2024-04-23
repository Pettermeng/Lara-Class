<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        return view('backend.master');
    }

    public function AddPost() {
        return view('backend.add-post');
    }

    public function ListPost() {
        return view('backend.list-post');
    }


}
