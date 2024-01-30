<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Category;
use App\Models\Market\Product;
use App\Models\Market\ProductItem;
use App\Models\Market\ProductItemDiscount;
use App\Models\Market\Slider;
use App\Services\Zarinpal\ZarinpalService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::where('is_active', 1)->get()->take(5);

        $products = Product::query()->with('items.discounts');
        $latestProducts = $products->orderBy('id', 'DESC')->where('is_active' , 1)->take(8)->get();
        $productPaginators = $products->paginate(8);

        
        // $Amount = $request->get('amount');

        // $zp = new ZarinpalService();
        // $result = $zp->verify($Amount);

        // if (isset($result["Status"]) && $result["Status"] == 100) {
        //     // Success
        //     echo "تراکنش با موفقیت انجام شد";
        //     echo "<br />مبلغ : " . $result["Amount"];
        //     echo "<br />کد پیگیری : " . $result["RefID"];
        //     echo "<br />Authority : " . $result["Authority"];
        // } else {
        //     // error
        //     echo "پرداخت ناموفق";
        //     echo "<br />کد خطا : " . $result["Status"];
        //     echo "<br />تفسیر و علت خطا : " . $result["Message"];
        // }

        $sliders = Slider::where('is_active', 1)->get()->take(5);

        $products = Product::where('is_active', 1)->with([
            'items.discounts' => function ($query) {
                $query->active();
            }
        ])->whereHas('items', function ($query) {
            $query->where('is_default', 1);
        })->get();


        return view('app.index', compact('sliders', 'productPaginators' , 'latestProducts'));
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
