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
}
