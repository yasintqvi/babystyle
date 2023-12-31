<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RoleRequest;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.roles.index');
        
    }

    public function fetch()
    {
        $roles = Role::query()->latest();

        if ($keyword = request('search')) {
            $roles->search($keyword);
        }

        $perPageItems = (int)request('paginate') !== 0 ? (int)request('paginate') : 15; 
        
        $roles = $roles->paginate($perPageItems);

        return response()->json($roles);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.user.roles.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $inputs = $request->all();

        $role = Role::create($inputs);

        $inputs['permissions'] = $inputs['permissions'] ?? [];

        $role->permissions()->sync($inputs['permissions']);

        return to_route('admin.user.roles.index')->with('success', "نقش  با موفقیت اضافه شد.");
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
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.user.roles.edit', compact('role' , 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $inputs = $request->all();

        $role->update($inputs);

        $inputs['permissions'] = $inputs['permissions'] ?? [];

        $role->permissions()->sync($inputs['permissions']);

        return to_route('admin.user.roles.index')->with('success', "نقش  با موفقیت ویرایش شد.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $brand)
    {
        // TODO check brand relations
        $brand->delete();

        return back()->with('success', "نقش با موفقیت حذف شد.");
    }

    public function batchDelete(Request $request) {        
        $request->validate([
            'ids.*' => 'required|exists:brands,id',
        ]);

        // TODO check brand relations

        Role::whereIn('id', $request->get('ids'))->delete();

        return back()->with('success', "حذف نقش ها با موفقیت انجام شد.");
    }
}
