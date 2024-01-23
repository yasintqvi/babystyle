<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Category;
use App\Models\Market\Product;
use App\Models\Market\ProductImage;
use App\Models\Market\ProductItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{

    const STORAGE_PATH = "images" . DIRECTORY_SEPARATOR . "products";

    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:manage_product')->only('index');
        $this->middleware('can:create_product')->only('edit', 'update');
        $this->middleware('can:edit_product')->only('store', 'create');
        $this->middleware('can:delete_product')->only('destroy');
    }


    public function index(): View
    {
        return view('admin.market.product.index');
    }

    /**
     * Fetch Data.
     */
    public function fetch()
    {
        $products = Product::query()->select('id', 'title', 'quantity', 'slug', 'primary_image', 'category_id', 'is_active', 'brand_id')->with(['category', 'brand'])->latest();

        if ($keyword = request('search')) {
            $products->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $products->active() : $products->notActive();
        }

        $perPageItems = (int) request('paginate') !== 0 ? (int) request('paginate') : 15;

        $products = $products->paginate($perPageItems);

        return response()->json($products);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::select('id', 'title')->get();

        $brands = Brand::select('id', 'persian_name')->get();

        return view('admin.market.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {
        $product = DB::transaction(function () use ($request, $imageService) {
            $inputs = $request->all();

            $imageService->setExclusiveDirectory(self::STORAGE_PATH);

            // save main product image
            $inputs['primary_image'] = $imageService->save($request->file('primary_image'));

            if ($request->hasFile('secondary_image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . "product-items");
                $inputs['secondary_image'] = $imageService->save($request->file('secondary_image'));
            }

            $product = Product::create($inputs);

            // save product images
            if ($request->filled('images')) {
                $productImages = explode(',', $request->get('images'));
                collect($productImages)->map(fn($image) => $product->images()->create(['image' => $image]));
            }

            return $product;
        });



        return to_route('admin.market.products.edit', $product->id)->with('success', "اطلاعات محصول با موفقیت ثبت شد.");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'title')->get();
        $brands = Brand::select('id', 'persian_name')->get();

        $product->load('category.variations');
        return view('admin.market.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $product = DB::transaction(function () use ($request, $imageService, $product) {

            $request->mergeIfMissing(['is_active' => 0]);

            $inputs = $request->all();

            if ($request->hasFile('primary_image')) {
                if (!empty($product->primary_image))
                    $imageService->deleteImage($product->primary_image);

                $inputs['primary_image'] = $imageService->save($request->file('primary_image'));
            }

            if ($request->hasFile('secondary_image')) {
                if (!empty($product->secondary_image))
                    $imageService->deleteImage($product->secondary_image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . "product-items");
                $inputs['secondary_image'] = $imageService->save($inputs['secondary_image']);
            }

            if ($request->filled('images')) {
                $productImages = explode(',', $request->get('images'));
                collect($productImages)->map(fn($image) => $product->images()->create(['image' => $image]));
            }

            $product->update($inputs);
        });
        return back()->with('success', 'اطلاعات با موفقیت بروز رسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function batchDelete(Request $request)
    {
        $request->validate([
            'ids.*' => 'required|exists:products,id',
        ]);

        Product::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف محصولات با موفقیت انجام شد.");
    }

    // for upload product images
    public function uploadImage(Request $request, ImageService $imageService)
    {

        $valiData = $request->validate([
            'file' => 'required|image|max:4096'
        ]);

        try {
            $imageService->setExclusiveDirectory(self::STORAGE_PATH . DIRECTORY_SEPARATOR . "galleries");
            $imageService->setImageName(time() . '-' . Str::random(3));
            $image = $imageService->save($valiData['file']);

            return response()->json([
                'success' => true,
                'path' => $image
            ]);
        } catch (\Exception $exception) {
            return false;
        }
    }

    // for delete product image
    public function destroyImage(ProductImage $productImage)
    {
        $productImage->delete();

        return response()->json(['success' => true, 'message' => 'File deleted successfully.'], 200);
    }
}

