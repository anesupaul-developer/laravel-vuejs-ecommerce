<?php

namespace App\Filament\Widgets;

use App\Definitions\UserType;
use App\Models\Product;
use App\Models\StoreAccount;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $customersCount = User::query()->whereHas('roles', function ($query) {
            return $query->where('name', '<>', UserType::getAdminRolesOnly());
        })->count();

        $totalProducts = Product::query()->where('is_approved', 0)->count();

        $totalAccounts = StoreAccount::query()->count();

        return [
            Card::make('Customers', $customersCount)
                ->description('Total Subscribers')
                ->descriptionIcon('heroicon-s-users')
                ->color('success'),
            Card::make('Products', $totalProducts)
                ->description('Awaiting Approval')
                ->descriptionIcon('heroicon-s-trending-down')
                ->color('danger'),
            Card::make('Store Accounts', $totalAccounts)
                ->description('Total Store Accounts')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),
        ];
    }
}
