<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;

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
        Paginator::useBootstrap();

        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            URL::forceScheme('https');
        } elseif (request()->server('HTTPS') === 'on' || request()->header('X-Forwarded-Proto') === 'https' || (isset($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'neospartan.seaseo.id'))) {
            URL::forceScheme('https');
        }

        Gate::before(function ($user, $ability) {
            $isAdmin = \App\Models\UsersRole::where('users_id', $user->id)
                ->whereIn('role_id', [1, 11])
                ->whereHas('role', function ($q) {
                    $q->whereIn('name', ['Pimpinan', 'Super Admin']);
                })
                ->exists();

            return $isAdmin ? true : null;
        });
    }
}
