<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('sku')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('stock')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image')
                    ->disk('public'),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                ReplicateAction::make(),
                Action::make('status')
                    ->label('Status Change')
                    ->icon('heroicon-o-arrow-path')
                    ->schema([
                        Toggle::make('is_active')
                            ->default(fn($record): bool => $record->is_active),
                    ])
                    ->action(function ($record) {
                        $record->update(['is_active' => !$record->is_active]);
                    })
                    ->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
