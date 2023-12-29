<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\SliderRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:manage_sldier')->only('index');
        $this->middleware('can:create_sldier')->only('edit', 'update');
        $this->middleware('can:edit_sldier')->only('store', 'create');
        $this->middleware('can:delete_sldier')->only('destroy');
    }

    public function index()
    {
        return view('admin.market.slider.index');
    }

    /**
     * Fetch Data.
     */
    public function fetch()
    {
        $sliders = Slider::query()->latest();

        if ($keyword = request('search')) {
            $sliders->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $sliders->active() : $sliders->notActive();
        }

        $perPageItems = (int) request('paginate') !== 0 ? (int) request('paginate') : 15;

        $sliders = $sliders->paginate($perPageItems);

        return response()->json($sliders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request, ImageService $imageService)
    {

        $request->mergeIfMissing(['is_active' => 0]);

        $inputs = $request->all();

        // save image
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "sliders");
            $inputs['image'] = $imageService->save($inputs['image']);
        }
        $slider = Slider::create($inputs);
        return to_route('admin.market.sliders.index')->with('success', "اسلایدر مورد نظر با موفقیت ایجاد شد.");

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
    public function edit(Slider $slider)
    {
        return view('admin.market.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider, ImageService $imageService)
    {

        $request->mergeIfMissing(['is_active' => 0]);

        $inputs = $request->all();
        // save image
        if ($request->hasFile('image')) {
            if (!empty($slider->logo))
                $imageService->deleteImage($slider->logo);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "sliders");
            $inputs['image'] = $imageService->save($inputs['image']);
        }

        $slider->update($inputs);
        return to_route('admin.market.sliders.index')->with('success', "اسلایدر مورد نظر با موفقیت بروز رسانی شد.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return back()->with('cute-success', 'اسلایدر حذف گردید.');
    }

    public function batchDelete(Request $request) {        
        $request->validate([
            'ids.*' => 'required|exists:sliders,id',
        ]);

        // TODO check category relations

        Slider::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف اسلایدر با موفقیت انجام شد.");
    }
}

