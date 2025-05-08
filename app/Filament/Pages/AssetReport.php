<?php

namespace App\Filament\Pages;

use App\Models\Aset;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Actions\Action; // yang benar


class AssetReport extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.asset-report';
    protected static ?string $navigationLabel = 'Laporan Aset';
    protected static ?string $title = 'Laporan Aset';
    protected static ?string $navigationGroup = 'Manajemen Aset';
    protected static ?int $navigationSort = 10;

    protected function getTableQuery()
    {
        return Aset::query();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(route('aset.export.pdf'))
                ->openUrlInNewTab(),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Nama Aset')->searchable(),
            TextColumn::make('code')->label('Kode')->searchable(),
            TextColumn::make('category')->label('Kategori'),
            TextColumn::make('condition')
                ->label('Kondisi')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'hilang' => 'warning',
                    'baik' => 'success',
                    'rusak' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn ($state) => match ($state) {
                    'hilang' => 'Hilang',
                    'baik' => 'Baik',
                    'rusak' => 'Rusak',
                    default => ucfirst($state),
                }),
            TextColumn::make('location')->label('Lokasi'),
            TextColumn::make('created_at')->label('Tanggal Masuk')->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d-m-Y')),
        ];
    }
}

