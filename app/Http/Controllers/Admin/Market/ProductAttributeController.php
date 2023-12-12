<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return response()->json($product->attributes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $validData = $request->validate([
            'key' => 'required|max:255',
            'value' => 'required|max:255',
        ]);

        $product->attributes()->create($validData);

        return response()->json(true, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductAttribute $attribute)
    {
        $attribute->delete();
        return response()->json(true, 200);
    }
}
