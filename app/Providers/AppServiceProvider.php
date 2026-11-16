<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengatur pengalihan otomatis setelah login berdasarkan role/kondisi user
        app()->bind(
            'Filament\Http\Responses\Auth\Contracts\LoginResponse',
            function () {
                return new class {
                    public function toResponse($request): Response
                    {
                        // Menggunakan Auth::user() agar dikenali sempurna oleh Intelephense
                        $user = Auth::user();

                        // 1. Jika Super Admin atau Admin Cabang -> Masuk ke Dashboard utama Filament
                        if ($user && ($user->name === 'Super Admin' || !empty($user->cabang))) {
                            return redirect()->intended(filament()->getUrl());
                        }

                        // 2. Jika Tutor -> Masuk langsung ke halaman Input Sesi
                        return redirect()->intended('/admin/input-sesi');
                    }
                };
            }
        );
    }
}