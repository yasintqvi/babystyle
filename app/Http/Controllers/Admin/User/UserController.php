<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.users.index');
    }

    public function fetch()
    {
        $users = User::query()->latest();

        if ($keyword = request('search')) {
            $users->search($keyword);
        }

        if ($status = request('status')) {
            $status === 'active' ? $users->active() : $users->notActive();
        }
        
        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $users = $users->paginate($perPageItems);

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request ,  ImageService $imageService , )
    {
        DB::transaction(function () use ($request, $imageService) {
            $inputs = $request->all();

            // save profile photo
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "user" . DIRECTORY_SEPARATOR . "avatars");
                $image = $imageService->save($request->image);
                $inputs['image'] = $image;
            }
            $inputs['password'] = Hash::make($request->password);
            $user = User::create($inputs);
            
        });
        return to_route('admin.user.users.index')->with('success', "کاربر  با موفقیت اضافه شد.");


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
    public function edit(User $user)
    {
        return view('admin.user.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, ImageService $imageService)
    {
        
        DB::transaction(function () use ($request, $user , $imageService) {
            $inputs = $request->all();

            [$inputs['is_staff'], $inputs['is_block']] = [$inputs['is_staff'] ?? 0, $inputs['is_block'] ?? 0];

            if ($request->hasFile('image')) {
                if (!empty($user->image))
                    $imageService->deleteImage($user->image);
    
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "avatars");
                $inputs['image'] = $imageService->save($inputs['image']);
            }
            $inputs['password'] = Hash::make($request->password);
            $user->update($inputs);
            
                
        });
        return to_route('admin.user.users.index')->with('success', "کاربر  با موفقیت ویرایش شد.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
