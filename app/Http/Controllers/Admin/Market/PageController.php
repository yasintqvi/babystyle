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

     public function __construct()
     {
         $this->middleware('can:manage_page')->only('index');
         $this->middleware('can:create_page')->only('edit', 'update');
         $this->middleware('can:edit_page')->only('store', 'create');
         $this->middleware('can:delete_page')->only('destroy');
     }

    public function index()
    {
        return view('admin.market.pages.index');
    }

    /**
     * Fetch Data.
     */
    public function fetch()
    {
        $pages = Page::query()->latest();

        if ($keyword = request('search')) {
            $pages->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $pages->active() : $pages->notActive();
        }

        $perPageItems = (int) request('paginate') !== 0 ? (int) request('paginate') : 15;

        $pages = $pages->paginate($perPageItems);

        return response()->json($pages);
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
        return view('admin.market.pages.edit', compact('page'));
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

    public function batchDelete(Request $request)
    {
        $request->validate([
            'ids.*' => 'required|exists:pages,id',
        ]);

        // TODO check pages relations

        Page::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف صفحات با موفقیت انجام شد.");
    }
}
