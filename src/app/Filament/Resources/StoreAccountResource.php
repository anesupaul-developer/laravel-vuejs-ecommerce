<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreAccountResource\Pages;
use App\Filament\Resources\StoreAccountResource\RelationManagers;
use App\Models\StoreAccount;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreAccountResource extends Resource
{
    protected static ?string $model = StoreAccount::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-cart';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Forms\Components\Card::make([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('user_id')
                    ->relationship('owner', 'name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->searchable(),
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('owner.name'),
                TextColumn::make('created_at')->dateTime('Y-m-d H:i')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoreAccounts::route('/'),
            'create' => Pages\CreateStoreAccount::route('/create'),
            'edit' => Pages\EditStoreAccount::route('/{record}/edit'),
        ];
    }
}
