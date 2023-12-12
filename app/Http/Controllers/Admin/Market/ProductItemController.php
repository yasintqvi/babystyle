<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductItemRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductItem;
use App\Models\Market\VariationOption;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        return view('admin.market.product.productItem.edit', compact('product', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductItemRequest $request, Product $product, ProductItem $item, ImageService $imageService)
    {
        $validData = $request->all();
        
        if ($request->hasFile('product_image')) {
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
}
