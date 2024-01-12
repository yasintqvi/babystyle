<?php

namespace App\Http\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Comment;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index(Product $product)
    {
        $comments = Comment::query()->where('user_id', auth()->id());
        $comments = $comments->paginate(7);
        return view('app.profile.comments' , compact('comments'));
    }
    public function store(Request $request, Product $product)
    {
        if(Auth::guest())
        {
            return back()->with('success' , 'برای اضافه کردن دیدگاه خود وارد حساب شوید');
        }else{
            $request->validate([
                'description' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'rate' => 'required|digits_between:0,5'
            ]);
    
            $inputs = $request->all();
            $inputs['user_id'] = auth()->user()->id;
            $inputs['product_id'] = $product->id;
    
            $comment = Comment::create($inputs);
    
            return back()->with('success' , 'کامنت شما با موفقیت ثبت شد');
        }

    }
}
