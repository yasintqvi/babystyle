<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductItem;
use App\Models\Market\ProductItemDiscount;
use App\Models\Market\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Product $product){
        $sliders = Slider::where('is_active' , 1)->get()->take(5);

        // $products = Product::where('is_active' , 1)->with('productItems')->get()->take(10);
        $products = Product::where('is_active' , 1)->get()->take(10);

        // $product = Product::find(2);

        // dd($product->finalDiscounts()->price_with_discount);

       


        // $products = Product::with('items')->where('is_active', 1)->whereHas('items', function ($productItem)
        // {
        //     $productItem->where('is_default' , 1);
        // })->get();

        // dd($products);


        return view('app.index' , compact('sliders' , 'products'));
    }
}
