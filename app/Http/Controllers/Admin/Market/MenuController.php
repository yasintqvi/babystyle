<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Brand;
use App\Models\Market\Category;
use App\Models\Market\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.market.menu.index');
    }

    /**
     * Fetch Data.
     */
    public function fetch()
    {
        $menus = Menu::query()->with('parent')->latest();

        if ($keyword = request('search')) {
            $menus->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $menus->active() : $menus->notActive();
        }

        $perPageItems = (int) request('paginate') !== 0 ? (int) request('paginate') : 15;

        $menus = $menus->paginate($perPageItems);

        return response()->json($menus);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::select('id', 'title', 'slug')->active()->get();
        $brands = Brand::select('id', 'persian_name', 'slug')->get();
        return view('admin.market.menu.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'ids.*' => 'required|exists:menus,id',
        ]);

        // TODO check category relations

        Menu::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف منو با موفقیت انجام شد.");
    }
}
