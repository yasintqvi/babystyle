<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\CategoryRequest;
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
                $variations = collect($request->get('variations'));
                $variations->map(fn($variation) => $category->variations()->create(['name' => $variation]));
            }

            return $category;
        });

        return to_route('admin.market.categories.index')->with('success', "دسته بندی $category->title با موفقیت اضافه شد.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
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
                $variations = collect($request->get('variations'));
                $category->variations()->delete();
                $variations->map(fn($variation) => $category->variations()->create(['name' => $variation]));
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
