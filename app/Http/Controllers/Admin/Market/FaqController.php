<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\FaqRequest;
use App\Models\Market\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.market.faqs.index');
    }


        /**
     * Fetch Data.
     */
    public function fetch()
    {
        $faqs = Faq::query()->latest();

        if ($keyword = request('search')) {
            $faqs->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $faqs->active() : $faqs->notActive();
        }
        
        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $faqs = $faqs->paginate($perPageItems);

        return response()->json($faqs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.faqs.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        $inputs = $request->all();
        $faqs = Faq::create($inputs);
        return to_route('admin.market.faqs.index')->with('success', "سوال مورد نظر با موفقیت ایجاد شد.");

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
    public function edit(Faq $faq)
    {
        return view('admin.market.faqs.edit' , compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $inputs = $request->all();
        $faq->update($inputs);
        return to_route('admin.market.faqs.index')->with('success', "سوالات متداول مورد نظر با موفقیت بروز رسانی شد.");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('cute-success', 'سوالات متداول حذف گردید.');
    }

    public function batchDelete(Request $request) {        
        $request->validate([
            'ids.*' => 'required|exists:faqs,id',
        ]);

        // TODO check faq relations

        Faq::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف پرسش ها با موفقیت انجام شد.");
    }
}
