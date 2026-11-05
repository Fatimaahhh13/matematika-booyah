<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable(false) // Kotak pencarian bawaan Filament tetap disembunyikan sesuai keinginanmu
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'Siswa') . '&background=0284c7&color=ffffff'),

                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable(), // Tanda panah pengurutan aktif di sini tanpa memunculkan kotak search bawaan

                TextColumn::make('school')
                    ->label('Sekolah')
                    ->default('-'),

                TextColumn::make('parent_name')
                    ->label('Nama Orang Tua')
                    ->default('-'),

                TextColumn::make('parent_phone')
                    ->label('No. Telepon Orang Tua')
                    ->default('-'),

                TextColumn::make('module')
                    ->label('Modul Awal')
                    ->default('-'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'aktif' => 'success',           // Warna hijau untuk aktif
                        'tidak_aktif', 'tidak aktif' => 'warning', // Warna kuning untuk tidak aktif
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match (strtolower($state)) {
                        'aktif' => 'Aktif',
                        'tidak_aktif', 'tidak aktif' => 'Tidak Aktif',
                        default => ucfirst($state),
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actionsColumnLabel('Aksi')
            ->recordActions([
                EditAction::make()
                    ->hiddenLabel()
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning'),

                DeleteAction::make()
                    ->hiddenLabel()
                    ->icon('heroicon-m-trash')
                    ->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}