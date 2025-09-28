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

        // Check if the request is for admin routes
        if ($request->is('admin/*') || $request->is('auth/admin/*')) {
            return route('admin.login');
        }

        // Check if the request is for doctor routes
        if ($request->is('dashboard/doctor/*') || $request->is('auth/doctor/*')) {
            return route('doctor.login');
        }

        // Default to user login
        return route('user.login');
    }
}
