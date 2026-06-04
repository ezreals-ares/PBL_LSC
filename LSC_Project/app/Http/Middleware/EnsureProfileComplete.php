<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    /**
     * Handle an incoming request.
     * Redirect customer to profile page if phone or address is not filled.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Only enforce for authenticated customers (admins have their own panel)
        if ($user && $user->role !== 'admin') {
            if (empty($user->phone) || empty($user->address)) {
                return redirect()
                    ->route('profile.edit')
                    ->with('incomplete_profile', true);
            }
        }

        return $next($request);
    }
}
