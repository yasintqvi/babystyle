<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Permission;
use Database\Seeders\PermissionSeeder;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    
    public function __invoke(Request $request)
    {
        if (Permission::all()->isEmpty()) {
            $permissionSeed = new PermissionSeeder;
            $permissionSeed->run();
        }

        

        return view('admin.dashboard');

    }
}
