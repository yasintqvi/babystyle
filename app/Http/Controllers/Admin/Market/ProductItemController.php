<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductItemRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductItem;
use App\Models\Market\ProductItemDiscount;
use App\Models\Market\VariationOption;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Fetch
     */

    public function fetch(Product $product)
    {
        $data = $product->load(['items' => function ($query) {
            $query->latest();
        }, 'items.variationOptions']);

        return response()->json($data, 200);
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
    public function store(ProductItemRequest $request, Product $product, ImageService $imageService)
    {
        $validData = $request->all();

        if ($request->hasFile('product_image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . "product_items");
            $validData['product_image'] = $imageService->save($request->file('product_image'));
        }

        return DB::transaction(function () use ($validData, $product) {

            $validData['sku'] = ProductItem::generateSKU();
            $productItem = $product->items()->create($validData);

            $productItemOptions = collect([]);

            collect($validData['options'])->map(function ($option) use ($productItemOptions) {
                if (!empty($option['value'])) {
                    // checking that the duplicate value is not stored
                    $variationOption = VariationOption::where('is_color', 0)->where('variation_id', $option['variation_id'])
                        ->where('value', $option['value']);

                    $variationOption = $variationOption->exists() ? $variationOption->first() : VariationOption::create($option);

                    $productItemOptions->push($variationOption->id);
                }
            });

            $productItemHasCurrentOptions = ProductItem::whereHas('variationOptions', function ($query) use ($productItemOptions) {
                $query->whereIn('variation_option_id', $productItemOptions);
            }, '=', count($productItemOptions))->get();

            if (collect($productItemHasCurrentOptions)->isNotEmpty()) {
                throw new HttpResponseException(
                    new JsonResponse(['message' => 'شما نمی توانید ویژگی های تکراری اضافه کنید.'], 500));
            }

            $productItem->variationOptions()->sync($productItemOptions);

            return response()->json(['success' => true, 'message' => 'محصول با ویژگی های جدید به انبار اضافه شد.'], 201);
        });

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, ProductItem $item)
    {
        $item->load('variationOptions');

        return view('admin.market.product.product-item.edit', compact('product', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductItemRequest $request, Product $product, ProductItem $item, ImageService $imageService)
    {
        $validData = $request->all();
        
        if ($request->hasFile('product_image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . "product_items");
            $validData['product_image'] = $imageService->save($request->file('product_image'));

            if (!empty($item->product_image)) {
                $imageService->deleteImage($item->product_image);
            }
        }

        return DB::transaction(function () use ($validData, $item) {

            $item->update($validData);

            $productItemOptions = collect([]);

            collect($validData['options'])->map(function ($option) use ($productItemOptions) {
                if (!empty($option['value'])) {
                    // checking that the duplicate value is not stored
                    $variationOption = VariationOption::where('is_color', 0)->where('variation_id', $option['variation_id'])
                        ->where('value', $option['value']);

                    $variationOption = $variationOption->exists() ? $variationOption->first() : VariationOption::create($option);

                    $productItemOptions->push($variationOption->id);
                }
            });

            $productItemHasCurrentOptions = ProductItem::whereNot('id', $item->id)->whereHas('variationOptions', function ($query) use ($productItemOptions) {
                $query->whereIn('variation_option_id', $productItemOptions);
            }, '=', count($productItemOptions))->get();

            if (collect($productItemHasCurrentOptions)->isNotEmpty()) {
                throw new HttpResponseException(
                    new JsonResponse(['message' => 'شما نمی توانید ویژگی های تکراری اضافه کنید.'], 500));
            }

            $item->variationOptions()->sync($productItemOptions);

            return back()->with('success', 'محصول با موفقیت بروز رسانی شد.' );
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeDiscount(Request $request, ProductItem $productItem) 
    {
        $validData = $request->validate([
            'discount_rate' => 'required|numeric|min:1|max:100',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
        ]);
        
        $startDate = dateFormating($request->start_date);
        $endDate = dateFormating($request->end_date);

        $existing_discount = $productItem->discounts()->where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $startDate)
                  ->where('end_date', '>=', $startDate)
                  ->orWhere('start_date', '<=', $endDate)
                  ->where('end_date', '>=', $endDate);
        })->first();

        if ($existing_discount) {
            return back()->with(['tab' => 'discount', 'error' => 'تخفیفی در این بازه ی زمانی فعال است.']);
        }
        
        [$validData['start_date'], $validData['end_date']] = [$startDate, $endDate];

        $productItem->discounts()->create($validData);

        return back()->with(['tab' => 'discount', 'success' => 'تخفیف روی محصول اعمال شد']);
    }

    public function expiration(ProductItemDiscount $productItemDiscount) 
    {
        $expiredDate = Carbon::now()->startOfMinute()->subMinute()->getTimestamp();

        $productItemDiscount->update([
            'end_date' => $expiredDate
        ]);

        return back()->with(['tab' => 'discount' ,'success' => 'تخفیف مورد نظر منفضی شد.']);
    }
}
