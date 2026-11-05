<?php

namespace App\Filament\Resources\Tutors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class TutorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi & Kredensial Tutor')
                    ->description('Lengkapi foto profil, nama, nomor telepon, email, dan kata sandi keamanan tutor.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        
                        // 1. Profile Photo dengan Kotak Drag & Drop Standar
                        FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->imageEditor()
                            ->directory('tutors-photos')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px dashed #d1d5db; border-radius: 0.75rem; background-color: #f9fafb; padding: 1rem;'
                            ]),

                        // 2. Tutor Name
                        TextInput::make('name')
                            ->label('Nama Tutor')
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('Contoh: Sarah Jenkins')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // 3. Phone Number
                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->prefixIcon('heroicon-o-phone')
                            ->placeholder('Contoh: 081234567890')
                            ->tel()
                            ->required()
                            ->maxLength(20)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // 4. Alamat Email
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->prefixIcon('heroicon-o-envelope')
                            ->placeholder('tutor@booyah.com')
                            ->required()
                            ->rule(fn ($record) => \Illuminate\Validation\Rule::unique('users', 'email')->ignore($record?->user_id))
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // Account Status (Disembunyikan saat Create, muncul saat Edit)
                        Hidden::make('status')
                            ->default('aktif'),

                        Select::make('status')
                            ->label('Status Akun')
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

                        // 5. Password
                        TextInput::make('password')
                            ->label('Kata Sandi')
                            ->password()
                            ->revealable()
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->placeholder('••••••••')
                            ->required(fn (string $context): bool => $context === 'create')
                            ->rule(
                                Password::min(8)
                                    ->numbers() // Hanya minimal 8 karakter dan wajib ada angka
                            )
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->formatStateUsing(fn () => null)
                            ->confirmed()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // 6. Confirm Password
                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi Kata Sandi')
                            ->password()
                            ->revealable()
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->placeholder('••••••••')
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrated(false)
                            ->formatStateUsing(fn () => null)
                            ->maxLength(255)
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