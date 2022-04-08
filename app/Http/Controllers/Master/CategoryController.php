<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Category;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();

        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name'  => 'required'
        ]);

        $category = Category::create([
            'category_name'      => $request->category_name,
            'active'    => $request->input('active', 1)
        ]);

        if($category){
            return response()->json([
                'success'   => true,
                'message'   => 'List Category Post',
                'data'      => $category
            ]);
        }else{
            return response()->json([
                'success'       => false,
                'message'       => 'Post Failed to Save',
                'data'          => $category
            ],200);
        }
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'success'   => true,
            'message'   => 'Detail Category',
            'data'      => $category
        ],200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_name'  => 'required'
        ]);

        $category = [
            'category_name'      => $request->category_name,
            'active'    => $request->active
        ];

        if($category){
            return response()->json([
                'success'   => true,
                'message'   => 'Success Category Update',
                'data'      => $category
            ]);
        }else{
            return response()->json([
                'success'       => false,
                'message'       => 'Update Failed to Save',
                'data'          => $category
            ],200);
        }
    }
}
