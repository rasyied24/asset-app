<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsetResource\Pages;
use App\Filament\Resources\AsetResource\RelationManagers;
use App\Models\Aset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class AsetResource extends Resource
{
    protected static ?string $model = Aset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Aset';
    protected static ?string $pluralLabel = 'Aset';
    protected static ?string $navigationGroup = 'Manajemen Aset';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Aset')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('code')
                    ->label('Kode Aset')
                    ->disabled()
                    ->dehydrated()
                    ->placeholder(fn () => \App\Models\Aset::generateNextCode())
                    ->maxLength(100),

                Forms\Components\TextInput::make('category')
                    ->label('Kategori')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('condition')
                    ->label('Kondisi')
                    ->required()
                    ->options([
                        'baik' => 'Baik',
                        'rusak' => 'Rusak',
                        'hilang' => 'Hilang',
                    ])
                    ->default('baik'),

                Forms\Components\DatePicker::make('purchase_date')
                    ->label('Tanggal Pembelian')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah')
                    ->required()
                    ->numeric(),

                Forms\Components\Textarea::make('description')
                    ->label('Keterangan')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->label('Kode')->searchable(),
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('category')->label('Kategori'),
                TextColumn::make('location')->label('Lokasi'),
                TextColumn::make('condition')->label('Kondisi')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'hilang' => 'warning',
                    'baik' => 'success',
                    'rusak' => 'danger',
                })
                ->formatStateUsing(fn ($state) => match ($state) {
                    'hilang' => 'Hilang',
                    'baik' => 'Baik',
                    'rusak' => 'Rusak',
                    default => ucfirst($state),
                }),

                TextColumn::make('purchase_date')->label('Tgl Beli')->date(),
                TextColumn::make('price')->label('Harga')->money('IDR'),
                TextColumn::make('quantity')->label('Jumlah'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('condition')
                    ->options([
                        'baik' => 'Baik',
                        'rusak' => 'Rusak',
                        'hilang' => 'Hilang',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAsets::route('/'),
            'create' => Pages\CreateAset::route('/create'),
            'edit' => Pages\EditAset::route('/{record}/edit'),
        ];
    }
}
