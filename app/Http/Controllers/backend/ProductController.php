<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $cate = DB::table('category')
                    ->orderByDesc('id')
                    ->get();

        $size = DB::table('attribute')
                    ->where('type', 'size')
                    ->get();

        $color = DB::table('attribute')
                    ->where('type', 'color')
                    ->get();

        return view('backend.add-product',[
            'cate'  => $cate,
            'size'  => $size,
            'color' => $color
        ]);
    }

    public function addProductSubmit(Request $rq)
    {
        if(!empty($rq))
        {
            $name    = $rq->name;
            $slug    = $this->slug($name);
            $qty     = $rq->qty;
            $r_price = $rq->regular_price;
            $s_price = $rq->sale_price;
            $size    = implode(', ', $rq->size);
            $color   = implode(', ', $rq->color);
            $cate    = $rq->category;
            $desc    =  $rq->description;

            $file = $rq->file('thumbnail');
            $thumbnail  = $this->uploadFile($file);

            $product = DB::table('product')->insert([
                'name'              => $name,
                'slug'              => $slug,
                'quantity'          => $qty,
                'regular_price'     => $r_price,
                'sale_price'        => $s_price,
                'attribute_size'    => $size,
                'attribute_color'   => $color,
                'category'          => $cate,
                'thumbnail'         => $thumbnail,
                'viewer'            => 0,
                'author'            => Auth::User()->id,
                'description'       => $desc,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            if($product) {
                return redirect('/admin/add-product');
            }

        }
    }

    public function listProduct()
    {
        $products = DB::table('product')
                        ->join('users', 'users.id', 'product.author')
                        ->join('category', 'category.id', 'product.category')
                        ->select('product.*', 'users.name AS author_name', 'category.name AS cate_name')
                        ->orderByDesc('product.id')
                        ->get();

        return view('backend.list-product',[
            'products' => $products
        ]);
    }
}
