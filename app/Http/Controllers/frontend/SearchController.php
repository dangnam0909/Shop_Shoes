<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Size;
use App\Brand;
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $search = str_replace('', '%', $search);
       
        $products = Product::with([
           'sizes' => function($query){
                return $query->orderBy('id','asc');},
            'productSizes'=> function($query){
                return $query->orderBy('id','asc');},
            'category','brand',
            'images' => function($query){
                return $query->where('status',1)->orderBy('updated_at','desc');
            }])
        ->where('name', 'like', '%'.$search.'%')
        ->orWhere('price','<=',$search)
        ->orderBy('id','desc')
        ->paginate(9);

        $categories = Category::with('products')->get();
       $sizes = Size::all();
       $brands = Brand::with('products')->get();

       //dd($products->isEmpty());

        return view('frontend.product.shop', compact('products','search','categories','sizes','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
