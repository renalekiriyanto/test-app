<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = \App\Models\Category::paginate(20);

        return response()->json([
            'data' => $data,
            'msg' => 'success'
        ]);
    }

    public function create(Request $r)
    {
        $r->validate([
            'name' => 'required|string|unique:categories'
        ]);

        try {
            $data = \App\Models\Category::where('name', $r->name)->first();

            if($data)
            {
                return response()->json([
                    'msg' => 'Data is already'
                ], 403);
            }

            $data = \App\Models\Category::create($r->name);

            return response()->json([
                'msg' => 'Data successfully created',
                'data' => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                'msg' => $err->getMessage()
            ], $err->getCode());
        }
    }

    public function delete(Category $category){
        $category->delete();

        return response()->json([
            'msg' => 'Data successfully deleted'
        ]);
    }

    public function update(Request $r, Category $category)
    {
        if(!$category){
            return response()->json([
                'msg' => 'Data is not found'
            ], 404);
        }

        try {
            $category->update([
                'name' => $r->name
            ]);
        } catch (Exception $err) {
            return response()->json([
                'msg' => $err->getMessage()
            ], $err->getCode());
        }
    }

    public function fetchById(Category $category){
        try {
            return response()->json([
                'msg' =>'Successfully fetched',
                'data' => $category
            ]);
        } catch (Exception $err) {
            return response()->json([
                'msg' => $err->getMessage()
            ], $err->getCode());
        }
    }
}
