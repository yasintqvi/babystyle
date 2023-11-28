<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\PageRequest;
use App\Models\Market\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 10; 

        $pages = Page::latest()->paginate(20);
        return view('admin.market.pages.index' , compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $inputs = $request->all();
        $pages = Page::create($inputs);
        return to_route('admin.market.pages.index')->with('success', "صفحه مورد نظر با موفقیت ایجاد شد.");

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
    public function edit(Page $page)
    {
        return view('admin.market.pages.edit' , compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        $inputs = $request->all();
        $page->update($inputs);
        return to_route('admin.market.pages.index')->with('success', "صفحه مورد نظر با موفقیت بروز رسانی شد.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return back()->with('cute-success', 'صفحه حذف گردید.');
    }
}
