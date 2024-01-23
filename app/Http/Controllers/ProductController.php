<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        try {
            $data = \App\Models\Product::paginate(20);

            if(!$data){
                return response()->json([
                    'msg' => 'Data is empty'
                ]);
            }

            return response()->json([
                'msg' => 'Successfully fetch data',
                'data' => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                'msg' => $err->getMessage()
            ], $err->getCode());
        }
    }

    public function create(Request $r)
    {
        $category = (int)$r->category_id;

        $r->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'string|max:255'
        ]);

        // Check data
        $data = \App\Models\Product::where('name', $r->name)->where('category_id', $category)
        ->first();

        if($data){
            return response()->json([
                'msg' => 'Data is already exists'
            ], 403);
        }

        $price = (float)$r->price;

        $data = \App\Models\Product::create([
            'name' => $r->name,
            'category_id' => (int)$category,
            'price' => $price,
            'description' => $r->description
        ]);

        return response()->json([
            'msg' => 'Successfully created data',
            'data' => $data
        ]);
    }

    public function update(Request $r, Product $product){
        $r->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'string|max:255'
        ]);

        if(!$product){
            return response()->json([
                'msg' => 'Data not found'
            ], 404);
        }

        try {

            $data = $product->update([
                'name' => $r->name,
                'category_id' => $r->category_id,
                'price' => (float)$r->float,
                'description' => $r->description
            ]);

            return response()->json([
                'msg' => 'Successfully updated',
                'data' => $product
            ]);

        } catch (Exception $err) {
            return response()->json([
                'msg' => $err->getMessage()
            ], $err->getCode());
        }
    }

    public function delete(Product $product)
    {
        try {
            $product->delete();

            return response()->json([
                'msg' => 'Data deleted'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'msg' => $err->getMessage()
            ], $err->getCode());
        }
    }

    public function fetchById(Product $product){
        try {
            return response()->json([
                'msg' =>'Successfully fetched',
                'data' => $product
            ]);
        } catch (Exception $err) {
            return response()->json([
                'msg' => $err->getMessage()
            ], $err->getCode());
        }
    }
}
