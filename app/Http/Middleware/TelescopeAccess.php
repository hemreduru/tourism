<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\LogHelper;

class TelescopeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only allow access to users with admin role
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            // Log successful Telescope access
            LogHelper::logDbOperation(
                'access',
                'Telescope',
                [
                    'url' => $request->fullUrl(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]
            );
            return $next($request);
        }

        // Log unauthorized access attempt
        if (auth()->check()) {
            LogHelper::logDbOperation(
                'access',
                'Telescope',
                [
                    'url' => $request->fullUrl(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ],
                null,
                false,
                'User does not have admin role'
            );
        } else {
            LogHelper::logDbOperation(
                'access',
                'Telescope',
                [
                    'url' => $request->fullUrl(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ],
                null,
                false,
                'User not authenticated'
            );
        }

        // For others, abort with 403 Forbidden
        abort(403, 'Unauthorized access.');
    }
}
