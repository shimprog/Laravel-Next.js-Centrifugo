<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityKeyCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header("Security") !== env("SECURITY_KEY")) {
            return response()->json(
                ["messages" => "Invalid security key."],
                400
            );
        }
        return $next($request);
    }
}
