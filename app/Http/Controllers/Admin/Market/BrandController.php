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
    public function index(): View
    {
        $perPageItems = (int) request('paginate') !== 0 ? (int) request('paginate') : 10;

        $brands = Brand::latest()->paginate($perPageItems);

        return view('admin.market.brand.index', compact('brands'));
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
        return redirect()->route('admin.market.brands.index')->with('swal-success', 'برند جدید شما با موفقیت ثبت شد');

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
        return redirect()->route('admin.market.brands.index')->with('swal-success', 'برند جدید شما با موفقیت ویرایش شد');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
