<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            $currentRoute = $request->route()->getName();
            
            if ($user->role === 'Admin') {
                if ($currentRoute !== 'dashboard') {
                    return redirect()->route('dashboard');
                }
            } else {
                if ($currentRoute !== 'beranda') {
                    return redirect()->route('beranda');
                }
            }
            
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}