<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('cabang')
                    ->label('Cabang')
                    ->default('-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match (strtolower($state ?? 'aktif')) {
                        'aktif', 'active' => 'Aktif',
                        'tidak_aktif', 'inactive', 'nonaktif' => 'Tidak Aktif',
                        default => 'Active',
                    })
                    ->color(fn (?string $state): string => match (strtolower($state ?? 'active')) {
                        'aktif', 'active' => 'success',
                        'tidak_aktif', 'inactive', 'nonaktif' => 'danger',
                        default => 'success',
                    })
                    ->default('active'),
            ])
            ->actions([
                EditAction::make()
                    ->label('')
                    ->tooltip('Edit')
                    ->icon('heroicon-m-pencil-square'),
                DeleteAction::make()
                    ->label('')
                    ->tooltip('Hapus')
                    ->modalHeading('Hapus Data Cabang')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data cabang ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->icon('heroicon-m-trash'),
            ])
            ->actionsColumnLabel('Actions')
            ->paginated([10, 25, 50, 100]);
    }
}