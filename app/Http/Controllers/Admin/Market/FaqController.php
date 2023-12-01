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
        $faqs = Faq::query();

        if ($searchString = request('search'))
        $faqs->where('question', "LIKE" , "%{$searchString}%");

        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 10; 

        $faqs = $faqs->latest()->paginate(20);
        return view('admin.market.faqs.index' , compact('faqs'));
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
        $pages = Faq::query();

        if ($searchString = request('search'))
        $pages->where('title', "LIKE" , "%{$searchString}%");

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
}
