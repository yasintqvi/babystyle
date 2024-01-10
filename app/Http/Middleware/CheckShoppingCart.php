<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userShoppingCart = $request->user()->shoppingCart()->first();        
        if ($userShoppingCart->items->isEmpty()) {
            return to_route('shopping-cart.index');
        }
        return $next($request);
    }
}
