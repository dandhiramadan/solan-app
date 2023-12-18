<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                switch ($user->role) {
                    case 'Follow Up':
                        return redirect()->route('dashboard.FollowUp');
                        break;
                    case 'Stock':
                        return redirect()->route('stock.dashboard');
                        break;
                    case 'Hitung Bahan':
                        return redirect()->route('hitungBahan.dashboard');
                        break;
                    case 'RAB':
                        return redirect()->route('rab.dashboard');
                        break;
                    case 'Penjadwalan':
                        return redirect()->route('jadwal.dashboard');
                        break;
                    case 'Operator':
                        return redirect()->route('operator.dashboard');
                        break;
                    case 'Accounting':
                        return redirect()->route('accounting.dashboard');
                        break;
                    case 'Purchase':
                        return redirect()->route('purchase.dashboard');
                        break;
                    // Tambahkan case untuk peran (role) lain jika diperlukan
                    default:
                        return redirect('/'); // Pengalihan default jika peran tidak cocok dengan yang diberikan dalam switch case
                }
            }
        }

        return $next($request);
    }
}
