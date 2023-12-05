<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Category;
use App\Models\Market\Product;
use App\Models\Market\ProductImage;
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
    public function index(): View
    {
        return view('admin.market.product.index');
    }

    /**
     * Fetch Data.
     */
    public function fetch()
    {
        $products = Product::query()->select('id', 'title', 'quantity', 'primary_image', 'category_id', 'is_active', 'brand_id')->with(['category', 'brand'])->latest();

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
                $inputs['secondary_image'] = $imageService->save($request->file('secondary_image'));
            }

            $product = Product::create($inputs);

            // save product images
            if ($request->has('images')) {
                $productImages = explode(',', $request->get('images'));
                collect($productImages)->map(fn($image) => $product->images()->create(['image' => $image]));
            }

            // save product attributes
            if ($request->has('attributes')) {
                $product->attributes()->createMany($request->get('attributes'));
            }

            return $product;
        });

        return to_route('admin.market.products.index')->with('success', "محصول $product->title با موفقیت اضافه شد.");
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
    public function destroyImage(Request $request)
    {
        $filePath = $request->get('path');

        if (!file_exists(public_path($filePath))) {
            return response()->json(['success' => false, 'message' => 'File not exist'], 404);
        }
        $result = unlink(public_path($filePath));

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'The file deletion operation encountered an error.'], 500);
        }   

        return response()->json(['success' => true, 'message' => 'File deleted successfully.'], 200);
    }
}

