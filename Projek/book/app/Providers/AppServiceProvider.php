<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Helpers\SimpleEncryption;

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
        // Biar semua view dapat user yang sudah didekripsi
        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                try {
                    $decryptedName = SimpleEncryption::decrypt($user->name, $user->pin);
                } catch (\Exception $e) {
                    $decryptedName = $user->name;
                }

                $view->with('decryptedUserName', $decryptedName);
            }
        });
    }
}
