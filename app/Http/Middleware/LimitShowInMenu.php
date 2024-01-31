<?php

namespace App\Http\Middleware;

use App\Models\Market\Category;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LimitShowInMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->filled("show_in_menu")) {
            $categoryCounts = Category::where("is_active", 1)->where("show_in_menu", 1)->count();

            if ($categoryCounts > 4) {
                return back()->with('toast-error', 'شما نمیتوانید بیشتر از چهار مورد را به منو اضافه کنید');
            }
        }

        return $next($request);
    }
}
