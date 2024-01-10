<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductItem;
use App\Models\Market\ShoppingCart;
use App\Models\Market\ShoppingCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ShoppingCartController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $userShoppingCart = Auth::user()->shoppingCart()->first();
        $shoppingCartItems = $userShoppingCart->items;
        return view('app.shopping-cart.index', compact('shoppingCartItems'));
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
    public function store(Request $request, Product $product)
    {

        $user = $request->user();

        $userShoppingCart = $user->shoppingCart()->first();

        if ($product->category->variations->isEmpty()) {
            $productItem = $product->items()->first();
            return $this->addToCart($user, $productItem, $userShoppingCart);
        }


        $optionsIds = $request->get('options');

        if ($optionsIds) {

            $productItemHasCurrentOptions = $product->items()->whereHas('variationOptions', function ($query) use ($optionsIds) {
                $query->whereIn('variation_option_id', $optionsIds);
            }, '=', count($optionsIds))->get();

            if (collect($productItemHasCurrentOptions)->isNotEmpty()) {
                $productItem = $productItemHasCurrentOptions->first();

                return $this->addToCart($user, $productItem, $userShoppingCart);
            }
        }

    }

    public function addToCart(User $user, ProductItem $productItem, $userShoppingCart)
    {
        if ($productItem->quantity > 0) {

            $isAlreadyExist = $userShoppingCart->items()->where('product_item_id', $productItem->id)->exists();

            if ($isAlreadyExist) {
                return response()->json(['success' => true, 'message' => 'محصول قبلا به سبد خریدتان اضافه شده است.', 'statusCode' => 200], 200);
            }

            $userShoppingCart->items()->create([
                'product_item_id' => $productItem->id,
                'quantity' => 1
            ]);

            return response()->json(['success' => true, 'message' => 'محصول به سبد خریدتان اضافه شد.', 'statusCode' => 201], 201);
        }

        return response()->json(['success' => false, 'message' => 'محصول در انبار یافت نشد.']);
    }

    public function getCartItemCount()
    {
        $user = Auth::user();
        $cartItemCount = $user->shoppingCart()->sum('quantity');

        dd($cartItemCount);

        return response()->json(['count' => $cartItemCount]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingCartItem $shoppingCartItem)
    {
        $shoppingCartItem->delete();

        return back()->with('success', 'محصول از سبد خرید حذف گردید.');
    }


    public function changeQuantity(Request $request, ShoppingCartItem $shoppingCartItem)
    {        
        $userShoppingCart = Auth::user()->shoppingCart()->first();

        if ($userShoppingCart->id !== $shoppingCartItem->cart_id) {
            return response()->json(['success' => false, 'message' => 'خطای عدم دسترسی'], 401);
        }


        $productItem = $shoppingCartItem->productItem;

        if ($productItem) {

            $action = $request->get('action') ?? 'plus';
            
            $productItemQty = $productItem->quantity - $productItem->frozen_number;

            $newQuantity = $action === 'plus' ? $shoppingCartItem->quantity + 1 : $shoppingCartItem->quantity - 1;
            
            if ($newQuantity < 1) {
                return response()->json(['success' => false , 'message' => 'حداقل باید یک عدد از محصول را سفارش دهید.']);
            }
            else if ($newQuantity > $productItemQty) {
                return response()->json(['success' => false , 'message' => 'موجودی محصول برای این تعداد کافی نمی باشد.']);
            }

            $shoppingCartItem->update(['quantity' => $newQuantity]);

            return response()->json(['success' => true, 'new_quantity' => $newQuantity]);
        }
    }


    public function getAmounts()
    {
        $shoppingCartItems = Auth::user()->shoppingCart()->first()->items;

        if ($shoppingCartItems->isEmpty()) {
            return response()->json(['total_amount' => 0, 'discount_amount' => 0]);
        }

        $totalAmount = 0;
        $discountAmount = 0;

        foreach($shoppingCartItems as $shoppingCartItem) {
            $productItem = $shoppingCartItem->productItem;
            if ($productItem->quantity > 0) {
                $discountAmount += ($productItem->price - $productItem->price_with_discount) * $shoppingCartItem->quantity;
                $totalAmount += $productItem->price * $shoppingCartItem->quantity;
            }
        }

        return response()->json(['total_amount' => $totalAmount, 'discount_amount' => $discountAmount]);
    }

}
