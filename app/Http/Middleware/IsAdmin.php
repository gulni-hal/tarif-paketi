<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kullanıcı giriş yapmış mı ve rolü 'admin' mi kontrol et
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Değilse yetkisiz erişim hatası ver veya ana sayfaya yönlendir
        return redirect('/')->withErrors(['Hata' => 'Bu sayfaya erişim yetkiniz yok.']);
    }
}
