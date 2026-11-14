<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PortfolioAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('portfolio_admin', false)) {
            return redirect()->route('admin')->with('msg', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
