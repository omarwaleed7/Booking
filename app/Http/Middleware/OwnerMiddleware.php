<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    // use api trait
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there is an authenticated user
        if (auth()->check()) {
            if (auth()->user()->id != $request->user_id) {
                return $this->apiResponse(null, 'Unauthorized: Owner only can make this action', 401);
            }
        } else {
            return $this->apiResponse(null, 'Unauthorized', 401);
        }

        return $next($request);
    }
}
