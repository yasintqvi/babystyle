<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Category;
use App\Models\Market\Product;
use App\Models\Market\ProductItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->with('items.discounts');

        $products->orderByRaw('quantity = 0');

        // filter 
        if ($filter = request('filter')) {

        }
        else {
            $products->latest();
        }

        $categories = Category::active()->get();


        $products = $products->paginate(16);

        return view('app.product.index', compact('products', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['items', 'category', 'images', 'attributes']);
        return view('app.product.show', compact('product'));
    }

    public function getPrice(Request $request, Product $product) 
    {

        $optionsIds = $request->get('options');

        if ($optionsIds) {
            $productItemHasCurrentOptions = $product->items()->whereHas('variationOptions', function ($query) use ($optionsIds) {
                $query->whereIn('variation_option_id', $optionsIds);
            }, '=', count($optionsIds))->get();

            if (collect($productItemHasCurrentOptions)->isNotEmpty()) {
                $productItemPrice = $productItemHasCurrentOptions->first()->price; 
                return response()->json(['success' => true, 'price' => $productItemPrice]);
            }

            return response()->json(['success' => true, 'price' => null]);
        }

        return false;
    }
}
