<?php

namespace App\Filament\Resources;

use App\Definitions\BaseDefinition;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationGroup = 'Resources';

    protected static ?string $navigationIcon = 'heroicon-s-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Forms\Components\Card::make([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name',
                        fn (Builder $query) => $query->where('is_admin_panel_user',BaseDefinition::IS_NOT_ADMIN))
                    ->label('Customer Name')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('subscription_id')
                    ->relationship('subscription', 'name')
                    ->label('Subscription')
                    ->searchable(),
                Forms\Components\Toggle::make('is_approved')
                    ->onIcon('heroicon-s-lightning-bolt')
                    ->offIcon('heroicon-s-lock-closed')
                    ->onColor('success')
                    ->offColor('danger')
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->getStateUsing(
                    static function (stdClass $rowLoop, HasTable $livewire): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * (
                                    $livewire->page - 1
                                ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('user.name')->label('Name'),
                Tables\Columns\TextColumn::make('user.email')->label('Email'),
                Tables\Columns\TextColumn::make('subscription.name')
                    ->label('Subscription')
                    ->color(fn($record) => $record->subscription ? $record->subscription->color_code : 'danger')
                    ->placeholder('N/A'),
                IconColumn::make('is_approved')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('Y-m-d H:i')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }    
}
