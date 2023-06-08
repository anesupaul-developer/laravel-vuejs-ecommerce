<?php

namespace App\Filament\Resources\StoreAccountResource\Pages;

use App\Filament\Resources\StoreAccountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoreAccount extends EditRecord
{
    protected static string $resource = StoreAccountResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return "Store account updated!";
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
