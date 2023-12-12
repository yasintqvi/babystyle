<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unSeenComments = Comment::where('is_seen' , 0)->get();

        foreach($unSeenComments as $unSeenComment){
            $unSeenComment->is_seen = 1;
            $result = $unSeenComment->save();
        }

        $comments = Comment::query();

        if ($searchString = request('search'))
        $comments->where('description', "LIKE" , "%{$searchString}%");

        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 10; 

        $comments = $comments->latest()->paginate(20);
        return view('admin.market.comments.index' , compact('comments'));
    }

        /**
     * Fetch Data.
     */
    public function fetch()
    {
        $comments = Comment::query()->with(['user', 'product'])->latest();

        if ($keyword = request('search')) {
            $comments->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'approved' ?  $comments->approved() : $comments->notApproved();
        }
        
        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $comments = $comments->paginate($perPageItems);

        return response()->json($comments);
    }



    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.market.comments.show' , compact('comment'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('cute-success', 'کامنت حذف گردید.');
    }

    public function changeApproved(Comment $comment){
        if($comment->getRawOriginal('is_approved')){
            $comment->update([
                'is_approved' => 0
            ]);
        }else{
            $comment->update([
                'is_approved' => 1
            ]);
        }

        return to_route('admin.market.comments.index')->with('success', "وضعیت کامنت با موفقیت تغیر کرد");

    }

    public function batchDelete(Request $request) {        
        $request->validate([
            'ids.*' => 'required|exists:comments,id',
        ]);

        // TODO check comment relations

        Comment::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف کامنت با موفقیت انجام شد.");
    }
}
