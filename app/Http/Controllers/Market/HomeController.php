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

        $products = Product::query()->with('items.discounts');
        $latestProducts = $products->orderBy('id', 'DESC')->take(8)->get();
        $products = $products->paginate(8);


        return view('app.index', compact('sliders', 'products' , 'latestProducts'));
    }

    public function products(Request $request)
    {

        if ($request->search) {
            $products = Product::where('title', "LIKE", "%" . $request->search . "%");
        }

        $categories = Category::active()->get();

        $products = $products->paginate(16);


        return view('app.product.index', compact('products', 'categories'));
    }
}
