<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionId = session()->getId();
        $ip = $request->ip();

        DB::table('visitors')->updateOrInsert(
            ['session_id' => $sessionId],
            [
                'user_id' => Auth::id(),
                'ip_address' => $ip,
                'last_activity' => now()
            ]
        );

        return $next($request);
    }
}
