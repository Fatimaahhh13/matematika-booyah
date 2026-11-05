<?php

namespace App\Filament\Resources\TeachingSessions\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TeachingSessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                /** @var \App\Models\User|null $user */
                $user = Auth::user();

                // Jika bukan super_admin, filter data berdasarkan cabang tutor yang mengajar
                if ($user && ! $user->hasRole('super_admin')) {
                    $branchId = $user->branch_id;

                    $query->whereHas('tutor', function (Builder $q) use ($branchId) {
                        $q->where('branch_id', $branchId);
                    });
                }
            })
            ->searchable(false)
            ->columns([
                // 1. Date (Diformat ke Bahasa Indonesia, misal: 24 September 2026)
                TextColumn::make('session_date')
                    ->label('Tanggal')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->locale('id')->translatedFormat('d F Y') : '-')
                    ->sortable(),

                // 2. Student Name
                TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->sortable()
                    ->placeholder('-'),

                // 3. Module
                TextColumn::make('module.title')
                    ->label('Modul')
                    ->placeholder('-'),

                // 4. Status Badge (Bahasa Indonesia: Selesai / Belum Selesai)
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state ?? '')) {
                        'selesai', 'completed' => 'success',
                        'belum_selesai', 'belum selesai', 'pending' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match (strtolower($state ?? '')) {
                        'selesai', 'completed' => 'Selesai',
                        'belum_selesai', 'belum selesai', 'pending' => 'Belum Selesai',
                        default => 'Selesai',
                    })
                    ->default('Selesai'),

                // 5. Notes
                TextColumn::make('notes')
                    ->label('Catatan')
                    ->limit(50)
                    ->placeholder('-'),
            ])
            ->defaultPaginationPageOption(5)
            ->paginationPageOptions([5, 10, 25, 50])
            ->filters([
                // Kosongkan agar tombol filter bawaan Filament tidak muncul
            ])
            ->actions([])
            ->bulkActions([]);
    }
}