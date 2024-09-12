<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function Home()
    {
        // Get new products
        $newProducts = DB::table('product')
                            ->orderByDesc('id')
                            ->limit(4)
                            ->get();

        // Get promotion products
        $promoProducts = DB::table('product')
                            ->where('sale_price', '>', 0)
                            ->orderByDesc('id')
                            ->limit(4)
                            ->get();

        // Get most view products
        $mostViewProducts = DB::table('product')
                                ->orderByDesc('viewer')
                                ->limit(4)
                                ->get();

        return view('frontend.home',[
            'newProducts'   => $newProducts,
            'promoProducts' => $promoProducts,
            'mostViewProducts' => $mostViewProducts
        ]);
    }

    public function Shop(Request $request)
    {
        //find offset
        $currentPage = $request->page;
        $limit  = 3;
        $offset = ($currentPage - 1) * $limit;

        $productObj = DB::table('product');

        // if user filter by category
        if($request->cat) {
            $catObj = DB::table('category')
                            ->where('slug', $request->cat)
                            ->get();
            $catId  = $catObj[0]->id;
            $products = $productObj->where('category', $catId)
                                ->offset($offset)
                                ->limit($limit)
                                ->orderByDesc('id');
            $allPosts  = DB::table('product')->where('category', $catId)->count();
        }
        else {
            $products = $productObj->offset($offset)
                                ->limit($limit)
                                ->orderByDesc('id');
            $allPosts  = DB::table('product')->count();
        }

        $products = $productObj->get();

        // total page
        $totalPage = ceil($allPosts / $limit);

        // get list category
        $category = DB::table('category')
                        ->orderByDesc('id')
                        ->get();

        return view('frontend.shop',[
            'products' => $products,
            'page'     => $totalPage,
            'category' => $category
        ]);
    }

    public function Product($slug)
    {
        $product = DB::table('product')
                        ->where('slug', $slug)
                        ->get();

        $proId       = $product[0]->id;
        $currentView = $product[0]->viewer;
        $newViewer   = $currentView + 1;
        DB::table('product')
            ->where('id', $proId)
            ->update([
                'viewer' =>$newViewer
            ]);

        // Get related products
        $catId =  $product[0]->category;
        $relatedPro = DB::table('product')
                        ->where('category', $catId)
                        ->where('id','<>', $proId)
                        ->orderByDesc('id')
                        ->get();

        return view('frontend.product',[
            'product'    => $product,
            'relatedPro' => $relatedPro
        ]);
    }

    public function News() {
        return view('frontend.news');
    }

    public function Article() {
        return view('frontend.news-detail');
    }

    public function Search() {
        return view('frontend.search');
    }

}
