<?php

namespace App\Filament\Resources\StoreAccountResource\Pages;

use App\Filament\Resources\StoreAccountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoreAccounts extends ListRecords
{
    protected static string $resource = StoreAccountResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
