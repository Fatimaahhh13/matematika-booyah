<?php

namespace App\Filament\Resources\Modules\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Modul & File')
                    ->description('Lengkapi detail modul pembelajaran, unggah gambar sampul, dan file materi PDF.')
                    ->icon('heroicon-o-book-open')
                    ->schema([
                        
                        // BARIS 1: Judul Modul
                        TextInput::make('title')
                            ->label('Judul Modul')
                            ->prefixIcon('heroicon-o-pencil-square')
                            ->placeholder('Contoh: Aljabar Dasar & Persamaan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1)
                            ->extraAttributes(['style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;']),

                        // Tingkat Level
                        Select::make('grade')
                            ->label('Tingkat Level')
                            ->prefixIcon('heroicon-o-academic-cap')
                            ->options([
                                'Level A' => 'Level A (Tingkat Dasar)',
                                'Level B' => 'Level B (Tingkat Menengah)',
                                'Level C' => 'Level C (Tingkat Lanjutan)',
                            ])
                            ->required()
                            ->native(false)
                            ->columnSpan(1)
                            ->extraAttributes(['style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;']),

                        // BARIS 2: Deskripsi Modul
                        Textarea::make('description')
                            ->label('Deskripsi Modul')
                            ->placeholder('Tuliskan ringkasan materi atau tujuan pembelajaran dari modul ini...')
                            ->rows(3)
                            ->columnSpanFull()
                            ->extraAttributes(['style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;']),
                    
                        // BARIS 3: Unggah Gambar Sampul
                        FileUpload::make('cover')
                            ->label('Gambar Sampul Modul')
                            ->helperText('Unggah gambar sampul (JPEG, PNG, WEBP - Maks 5MB)')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->directory('module-covers')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->columnSpanFull()
                            ->extraAttributes(['style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;']),

                        // BARIS 4: File PDF
                        FileUpload::make('file_path')
                            ->label('File Modul (Khusus PDF)')
                            ->helperText('Unggah file materi pembelajaran dalam format .pdf (Maksimum 10MB)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('modules-pdf')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(10240)
                            ->preserveFilenames()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull()
                            ->extraAttributes(['style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;']),

                        ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->extraAttributes([
                        'class' => '[&_.fi-section-header]:border-b-0'
                    ]),
            ]);
    }
}