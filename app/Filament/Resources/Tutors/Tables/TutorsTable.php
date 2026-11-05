<?php

namespace App\Filament\Resources\Tutors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TutorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->columns([
                // 1. Photo / Avatar
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('https://ui-avatars.com/api/?background=0D8ABC&color=fff')),

                // 2. Tutor Name (Mengambil data dari relasi user.name)
                TextColumn::make('user.name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable()
                    ->weight('bold')
                    ->default('-'),

                // 3. Email (Mengambil data dari relasi user.email)
                TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable()
                    ->default('-'),

                // 4. Phone
                TextColumn::make('phone')
                    ->label('Telepon')
                    ->default('-'),

                // 5. Status Badge (Diterjemahkan ke Bahasa Indonesia)
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state ?? '')) {
                        'aktif', 'active' => 'success',
                        'tidak_aktif', 'inactive', 'nonaktif' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match (strtolower($state ?? '')) {
                        'aktif', 'active' => 'Aktif',
                        'tidak_aktif', 'inactive', 'nonaktif' => 'Tidak Aktif',
                        default => ucfirst(str_replace('_', ' ', $state ?? 'Aktif')),
                    })
                    ->default('Aktif'),
            ])
            ->actionsColumnLabel('Aksi')
            ->recordActions([
                EditAction::make()
                    ->label('')
                    ->icon('heroicon-m-pencil-square'),

                DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-m-trash')
                    ->modalHeading('Hapus Data Tutor')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data tutor ini?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->modalHeading('Hapus Data Tutor Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data tutor yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal'),
                ]),
            ]);
    }
}