<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function addCategory() {
        return view('backend.add-category');
    }

    public function addCategorySubmit(Request $request) {
        $name = $request->name;
        $slug = $this->slug($name);
        $date = date('Y-m-d H:i:s');

        $category = DB::table('category')->insert([
            'name' => $name,
            'slug' => $slug,
            'created_at'=> $date,
            'updated_at'=> $date,
        ]);

        if($category) {
            return redirect('/admin/add-category')->with('message', 'Post Inserted');
        }
    }

    public function ListCategory() {
        return view('backend.list-category');
    }
}
