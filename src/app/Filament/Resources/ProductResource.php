<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\User;
use Exception;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    protected static ?string $navigationGroup = 'Resources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Forms\Components\Card::make([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\Textarea::make('description'),
                FileUpload::make('image_url')
                    ->label('Upload Image')
                    ->directory('product_images')
                    ->enableDownload()
                    ->enableOpen(),
                Forms\Components\Select::make('user_id')
                    ->relationship('owner', 'name'),
                Forms\Components\Toggle::make('is_approved')
                    ->onIcon('heroicon-s-lightning-bolt')
                    ->offIcon('heroicon-s-lock-closed')
                    ->onColor('success')
                    ->offColor('danger')
            ]));
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('owner.name'),
                TextColumn::make('price')->sortable(),
                IconColumn::make('is_approved')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('approver.name')
                    ->placeholder('N/A'),
                TextColumn::make('created_at')->dateTime('d-M-Y H:i')
            ])
            ->filters([
                Filter::make('approved')
                    ->query(fn (Builder $query): Builder => $query->where('is_approved', true)),
                Filter::make('not_approved')
                    ->query(fn (Builder $query): Builder => $query->where('is_approved', false))
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
