<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;

use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

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
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-s-cog'),
                NavigationGroup::make()
                    ->label('Resources')
                    ->icon('heroicon-s-collection')
            ]);
        });

        Filament::registerNavigationGroups([
            'Resources',
            'Settings',
        ]);

//        Filament::serving(function () {
//            Filament::registerViteTheme('resources/css/filament.css');
//        });
    }
}
