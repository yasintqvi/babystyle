<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('can:manage_brand')->only('index');
         $this->middleware('can:create_brand')->only('edit', 'update');
         $this->middleware('can:edit_brand')->only('store', 'create');
         $this->middleware('can:delete_brand')->only('destroy');
     }

    public function index(): View
    {
        return view('admin.market.brand.index');
    }

        /**
     * Fetch Data.
     */
    public function fetch()
    {
        $brands = Brand::query()->latest();

        if ($keyword = request('search')) {
            $brands->search($keyword);
        }
        
        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $brands = $brands->paginate($perPageItems);

        return response()->json($brands);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request, ImageService $imageService): RedirectResponse
    {

        $inputs = $request->all();

        // save image
        if ($request->hasFile('logo')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "brands");
            $inputs['logo'] = $imageService->save($inputs['logo']);
        }
        $brand = Brand::create($inputs);
        return to_route('admin.market.brands.index')->with('success', "برند مورد نظر با موفقیت ایجاد شد.");

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
    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs = $request->all();
        // save image
        if ($request->hasFile('logo')) {
            if (!empty($brand->logo))
                $imageService->deleteImage($brand->logo);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "brands");
            $inputs['logo'] = $imageService->save($inputs['logo']);
        }

        $brand->update($inputs);
        return to_route('admin.market.brands.index')->with('success', "برند مورد نظر با موفقیت بروز رسانی شد.");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // TODO check brand relations
        $brand->delete();

        return back()->with('success', "دسته بندی با موفقیت حذف شد.");
    }

    public function batchDelete(Request $request) {        
        $request->validate([
            'ids.*' => 'required|exists:brands,id',
        ]);

        // TODO check brand relations

        Brand::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف برند ها با موفقیت انجام شد.");
    }
}
