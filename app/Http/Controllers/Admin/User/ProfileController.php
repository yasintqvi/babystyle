<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.user.profile.index' , ['user' => auth()->user()]);
    }
    
    public function security()
    {
        return view('admin.user.profile.security' , ['user' => auth()->user()]);
    }

    public function update(Request $request,ImageService $imageService)
    {
        $user = auth()->user();


        $validated = $request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => ['nullable', Rule::unique('users' , 'email')->ignore($user->id),'email'],
            'phone_number' => ['required', 'numeric' , Rule::unique('users' , 'phone_number')->ignore($user->id), 'regex:/09(1[0-9]|9[1-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/i', 'digits:11'],
            'image' => 'nullable|image|max:2048|min:1',
        ]);

      

        $validated['phone_number'] = formatPhoneNumber($request->phone_number);
        $user->update($validated);
        return redirect()->back()->with('success', "کاربر  با موفقیت ویرایش شد.");        
    }

    public function updateImage(Request $request, User $user, ImageService $imageService)
    {
        $user = auth()->user();



        $validated = $request->validate([
            'image' => 'nullable|image|max:2048|min:1',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($user->image))
                $imageService->deleteImage($user->image);
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "avatars");
            $image = $imageService->save($request->image);
            $validated['image'] = $image;
        }

        $user->update($validated);
        return redirect()->back()->with('success', "کاربر  با موفقیت ویرایش شد.");      

    }
    
}
