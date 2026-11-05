<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Cabang & Akun')
                    ->description('Lengkapi informasi nama pengguna, asal cabang, email, serta kredensial akses.')
                    ->icon('heroicon-o-building-storefront')
                    ->schema([
                        
                        // Username / Name
                        TextInput::make('name')
                            ->label('Nama Pengguna / Nama')
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('Contoh: Admin Jakarta')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // Branch Origin (TextInput teks bebas)
                        TextInput::make('cabang')
                            ->label('Asal Cabang')
                            ->prefixIcon('heroicon-o-map-pin')
                            ->placeholder('Contoh: Cabang Banjarmasin / Cabang Jakarta')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // Account Status
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

                        // Email Address
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->prefixIcon('heroicon-o-envelope')
                            ->placeholder('contoh@email.com')
                            ->required()
                            ->unique(ignoreRecord: true, table: 'users', column: 'email')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // Password
                        TextInput::make('password')
                            ->label('Kata Sandi')
                            ->password()
                            ->revealable()
                            ->prefixIcon('heroicon-o-key')
                            ->placeholder('••••••••')
                            ->required(fn (string $context): bool => $context === 'create')
                            ->rule(
                                Password::min(8)
                                    ->numbers()
                            )
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->confirmed()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'style' => 'border: 1.5px solid #d1d5db; border-radius: 0.5rem; background-color: #ffffff;'
                            ]),

                        // Password Confirmation
                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi Kata Sandi')
                            ->password()
                            ->revealable()
                            ->prefixIcon('heroicon-o-key')
                            ->placeholder('••••••••')
                            ->required(fn (string $context): bool => $context === 'create')
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