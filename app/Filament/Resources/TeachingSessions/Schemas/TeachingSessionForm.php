<?php

namespace App\Filament\Resources\TeachingSessions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TeachingSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tutor_id')
                    ->label('Tutor')
                    ->relationship('tutor', 'id', fn ($query) => $query->with('user'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Tutor #{$record->id}")
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('student_id')
                    ->label('Siswa')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('module_id')
                    ->label('Modul')
                    ->relationship('module', 'title') // Sesuaikan 'title' jika nama kolom di tabel modules berbeda
                    ->searchable()
                    ->preload()
                    ->nullable(),

                DatePicker::make('session_date')
                    ->label('Tanggal Sesi')
                    ->required(),

                Textarea::make('notes')
                    ->label('Catatan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}