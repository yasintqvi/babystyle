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
    public function index(Request $request, Category $category = null)
    {
        $products = Product::query()->with('items.discounts');

        if ($category) {
            $products->where('category_id', $category->id);
        }


        $products->orderByRaw('quantity = 0');

        // filter 
        if ($filter = request('filter')) {
            dd('hi');
        } else {
            $products->latest();
        }

        $categories = Category::active()->get();

        $products = $products->paginate(16);

        return view('app.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function search(Request $request)
    {   

        // $products = Product::query()->with('items')->whereHas('items', function($query) {
        //     $query->where('is_default', 1);
        // })->get();

            // $cheapestProduct = Product::query()
            // ->select('products.*')
            // ->join('product_items', 'products.id', '=', 'product_items.product_id')
            // ->orderBy('product_items.price')
            // ->get();

            $cheapestProduct = Product::query()
            ->select('products.*')
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->orderBy('product_items.price', 'ASC');
        
        switch ($request->sort) {
            case "1":
                $column = "created_at";
                $direction = "DESC";
                break;
            case "2":
                $column = "sold_number";
                $direction = "DESC";
                break;
            case "3":
            case "4":
                $column = "product_items.price";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "DESC";    
        }
        
        $cheapestProduct->orderBy($column, $direction);
        $cheapestProduct = $cheapestProduct->get();
        


        $productsQuery = Product::query();

        if ($request->search) {
            $productsQuery->where('title', "LIKE", "%" . $request->search . "%")->orderBy($column, $direction)->get();
        }else{
            $productsQuery->orderBy($column, $direction)->get();
        }

        $categories = Category::active()->get();


        $products = $productsQuery->paginate(16);

        return view('app.product.index', compact('categories', 'products'));
    }
}
