<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Actions\Action;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->description('Isi Informasi Produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description'),
                        ]),
                    // Step::make('Product Prices')
                    Step::make('Product Price and Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Isi Harga Produk')
                        ->schema([
                            Group::make([
                                TextInput::make('price')
                                    ->rules('required | integer | min:1')
                                    ->validationMessages([
                                        'required' => 'Harga wajib diisi.',
                                        'integer' => 'Harga harus berupa angka.',
                                        'min' => 'Harga minimal 1.',
                                    ]),
                                TextInput::make('stock')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')
                        ]),
                    // Step::make('media')
                    Step::make('Media and Status')
                        ->icon('heroicon-o-photo')
                        ->description('Isi Gambar Produk')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('product-images'),
                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured'),
                        ]),
                ])
                ->columnSpanFull()
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->button()
                        ->color('primary')
                        ->submit('save'),
                )
            ]);
    }
}