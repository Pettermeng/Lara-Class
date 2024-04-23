<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function AddCategory() {
        return view('backend.add-category');
    }

    public function AddCategorySubmit(Request $request) {
    }

    public function ListCategory() {
        return view('backend.list-category');
    }
}
