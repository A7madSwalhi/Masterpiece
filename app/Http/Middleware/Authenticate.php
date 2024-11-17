<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        if ($request->expectsJson()) {
            return null;
        }


        if ($request->route() && $request->route()->getName() && str_starts_with($request->route()->getName(), 'admin.')) {
            return route('admin.login');
        }


        if ($request->route() && $request->route()->getName() && str_starts_with($request->route()->getName(), 'vendor.')) {
            return route('vendor.login');
        }

        
        return route('login');
    }
}
