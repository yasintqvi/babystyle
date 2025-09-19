<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use App\Models\User;
use App\Models\User\Permission;
use Database\Seeders\PermissionSeeder;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{


    public function __invoke(Request $request)
    {
        if (Permission::all()->isEmpty()) {
            $permissionSeed = new PermissionSeeder;
            $permissionSeed->run();
        }


        $todayOrders = Order::where('created_at', ">=", Carbon::today())->where('created_at', "<=", Carbon::tomorrow())->count();

        $todayIncome = Order::where('created_at', ">=", Carbon::today())->where('created_at', "<=", Carbon::tomorrow())->sum('final_amount');

        $todayCustomers = User::where('created_at', ">=", Carbon::today())->where('created_at', "<=", Carbon::tomorrow())->count();

        $onlineVisitors = DB::table('visitors')
            ->where('last_activity', '>=', now()->subMinutes(5))
            ->count();

        $onlineUsers = DB::table('visitors')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', now()->subMinutes(5))
            ->count();

        $onlineGuests = DB::table('visitors')
            ->whereNull('user_id')
            ->where('last_activity', '>=', now()->subMinutes(5))
            ->count();

        // dd($onlineVisitors);

        return view('admin.dashboard', compact('todayOrders', 'todayIncome', 'todayCustomers', 'onlineVisitors', 'onlineUsers', 'onlineGuests'));

    }
}
