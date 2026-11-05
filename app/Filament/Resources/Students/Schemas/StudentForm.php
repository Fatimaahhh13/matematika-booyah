<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Siswa')
                    ->description('Lengkapi foto siswa, sekolah, data orang tua, dan modul yang diikuti.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        
                        // 1. Photo (Kotak Drag & Drop)
                        FileUpload::make('avatar')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->directory('students-photos')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px dashed #d1d5db; border-radius: 0.75rem; background-color: #f9fafb; padding: 1rem;'
                            ]),

                        // 2. Student Name
                        TextInput::make('name')
                            ->label('Nama Siswa')
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('Contoh: Arif Rahman')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // 3. School
                        TextInput::make('school')
                            ->label('Sekolah')
                            ->prefixIcon('heroicon-o-building-library')
                            ->placeholder('Contoh: SD Negeri 1 Jakarta')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // 4. Parent Name
                        TextInput::make('parent_name')
                            ->label('Nama Orang Tua')
                            ->prefixIcon('heroicon-o-users')
                            ->placeholder('Contoh: Budi Santoso')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // 5. Parent Phone
                        TextInput::make('parent_phone')
                            ->label('Nomor Telepon Orang Tua')
                            ->prefixIcon('heroicon-o-phone')
                            ->placeholder('Contoh: 081234567890')
                            ->tel()
                            ->required()
                            ->maxLength(20)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // 6. Initial Module (Dikelompokkan dan diurutkan berdasarkan grade)
                        Select::make('module')
                            ->label('Modul Awal')
                            ->prefixIcon('heroicon-o-book-open')
                            ->options(function () {
                                return \App\Models\Module::all()
                                    ->sortBy('grade') // Mengurutkan berdasarkan level/grade terlebih dahulu
                                    ->groupBy('grade')
                                    ->map(function ($modules) {
                                        return $modules->pluck('title', 'title')->toArray();
                                    })->toArray();
                            })
                            ->placeholder('Pilih modul...')
                            ->native(true)
                            ->required()
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // Status (Disembunyikan saat Create, tampil saat Edit)
                        Hidden::make('status')
                            ->default('aktif'),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'aktif' => 'Aktif',
                                'tidak_aktif' => 'Tidak Aktif',
                            ])
                            ->default('aktif')
                            ->required()
                            ->hiddenOn('create')
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'background-color: #ffffff; border: 1.5px solid #e5e7eb; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); padding: 1.5rem;',
                        'class' => '[&_.fi-section-header]:border-b-0'
                    ]),
            ]);
    }
}