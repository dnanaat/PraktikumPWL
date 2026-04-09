<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Details')
                        ->icon('heroicon-s-information-circle')
                        ->badge('Details')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('id')
                                    ->label('Product ID'),

                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Product Description'),

                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),
                        Tab::make('Product Price and Stock')
                        ->icon('heroicon-s-currency-dollar')
                        ->badge('Price & Stock')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-currency-dollar'),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->badge()
                                    ->color(fn ($state) => $state > 0 ? 'info' : 'danger'),
                            ]),
                        Tab::make('Image and Status')
                        ->icon('heroicon-s-photo')
                        ->badge('Image & Status')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-s-currency-dollar'),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->color('primary'),
                                IconEntry::make('is_active')
                                    ->label('Active Status')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Featured Status')
                                    ->boolean(),
                            ]),
                    ]) ->columnSpanFull() ->vertical(),
                Section::make('Product Info')
                    ->description('')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('id')
                            ->label('Product ID'),
                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('description')
                            ->label('Product Description'),
                        TextEntry::make('created_at')
                            ->label('Product Created At')
                            ->date('d M Y')
                            ->color('info'),
                    ])
                ->columnSpanFull(),
                Section::make('Product Price and Stock')
                    ->description('')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->formatStateUsing(fn ($state) => 'Rp' . number_format($state, 2, ',', '.'))
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('Product Stock'),
                    ])
                ->columnSpanFull(),
                Section::make('Image and Status')
                    ->description('')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->formatStateUsing(fn ($state) => 'Rp' . number_format($state, 2, ',', '.'))
                            ->icon('heroicon-s-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-archive-box'),
                        IconEntry::make('is_active')
                            ->label('Active Status')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Featured Status')
                            ->boolean(),
                    ])
                ->columnSpanFull(),
            ]);
    }
}
