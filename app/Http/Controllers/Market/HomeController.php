<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Category;
use App\Models\Market\Product;
use App\Models\Market\ProductItem;
use App\Models\Market\ProductItemDiscount;
use App\Models\Market\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Product $product)
    {
        $sliders = Slider::where('is_active', 1)->get()->take(5);
   

        $products = Product::where('is_active' , 1)->with(['items.discounts' => function ($query) {
            $query->active();
        }])->whereHas('items', function ($query) {
            $query->where('is_default', 1);
        })->get();

        return view('app.index', compact('sliders', 'products'));
    }

    public function products(Request $request)
    {

        if($request->search)
        {
            $products = Product::where('title', "LIKE", "%" . $request->search . "%");
        }

        $categories = Category::active()->get();

        $products = $products->paginate(16);


        return view('app.product.index', compact('products' , 'categories'));

    }
}
