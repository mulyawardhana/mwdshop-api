<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Product;
use Auth;
use DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if($search == null){
            $products = DB::table('products')
                    ->join('categories','categories.id', '=', 'products.category_id')
                    ->select('categories.category_name','products.name','products.unit','products.desc','products.price','products.stock')
                    ->get();
            return response()->json($products);
        }else{
            $products = DB::table('products')
                    ->join('categories','categories.id', '=', 'products.category_id')
                    ->select('products.id','categories.category_name','products.name','products.unit','products.desc','products.price','products.stock')
                    ->where('name', 'like', '%'.$search.'%')
                    ->orWhere('category_name', 'like', '%'.$search.'%')
                    ->orWhere('unit', 'like', '%'.$search.'%')
                    ->orWhere('desc', 'like', '%'.$search.'%')
                    ->orWhere('price', 'like', '%'.$search.'%')
                    ->orWhere('stock', 'like', '%'.$search.'%')
                    ->get();
            return response()->json($products);
        }

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'          => 'required',
            'unit'          => 'required',
            'category_id'   => 'required',
            'price'         => 'required',
        ]);

        $products = Product::create([
            'name'          => $request->name,
            'unit'          => $request->unit,
            'category_id'   => $request->category_id,
            'price'         => $request->price,
            'image'         => $request->input('image','test'),
            'desc'          => $request->desc,
            'stock'         => $request->stock,
            'created_by'    => Auth::user()->id
        ]);

        if($products){
            return response()->json([
                'success'   => true,
                'message'   => 'List Product Post',
                'data'      => $products
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Product Has failed to save',
                'data'      => $products
            ]);
        }
    }
}
