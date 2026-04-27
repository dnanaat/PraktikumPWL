<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\ReplicateAction;

use function Laravel\Prompts\text;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->toggleable()
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ReplicateAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
