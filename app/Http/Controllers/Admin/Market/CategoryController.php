<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\CategoryRequest;
use App\Models\Market\Variation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Market\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('can:manage_category')->only('index');
         $this->middleware('can:create_category')->only('edit', 'update');
         $this->middleware('can:edit_category')->only('store', 'create');
         $this->middleware('can:delete_category')->only('destroy');
     }

    public function index():View
    {
        return view('admin.market.category.index');
    }

    /**
     * Fetch Data.
     */
    public function fetch()
    {
        $categories = Category::query()->latest();

        if ($keyword = request('search')) {
            $categories->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $categories->active() : $categories->notActive();
        }
        
        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $categories = $categories->paginate($perPageItems);

        return response()->json($categories);
    }

    /** 
     * get all variations of category
     * */ 

    public function fetchVariations(Category $category) {
        if (!$category->variations) {
            return response()->noContent();
        }
        
        return response()->json($category->variations, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.market.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = DB::transaction(function() use($request) {
            $category = Category::create($request->all());

            if ($request->has('variations')) {
                $variations = $request->get('variations');
                $category->variations()->createMany($variations);
            }

            return $category;
        });

        return to_route('admin.market.categories.index')->with('success', "دسته بندی $category->title با موفقیت اضافه شد.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('admin.market.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

        DB::transaction(function() use($request, $category) {
            $request->mergeIfMissing(['is_active' => 0]);
    
            $category->update($request->all());
            
            if ($request->has('variations')) {
                $variations = $request->get('variations');

                $newVariationIds = array_column($variations, 'variation_id');
                $category->variations()->whereNotIn('id', $newVariationIds)->delete();

                foreach ($variations as $variation) {
                    $category->variations()->updateOrCreate(['id' => $variation['variation_id'] ?? null], $variation);
                }
            }
            else {
                $category->variations()->delete();
            }
            
        });

        return to_route('admin.market.categories.index')->with('success', "دسته مورد نظر با موفقیت بروز رسانی شد.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // TODO check category relations
        $category->delete();

        return back()->with('success', "دسته بندی با موفقیت حذف شد.");

    }

    public function batchDelete(Request $request) {        
        $request->validate([
            'ids.*' => 'required|exists:categories,id',
        ]);

        // TODO check category relations

        Category::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف دسته بندی با موفقیت انجام شد.");
    }
}
