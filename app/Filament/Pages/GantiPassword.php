<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use BackedEnum;

class GantiPassword extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-m-key';
    protected static ?string $navigationLabel = 'Ganti Password';
    protected static ?string $title = 'Ganti Password';
    protected string $view = 'filament.pages.ganti-password';

    protected static bool $shouldRegisterNavigation = false;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    public static function canAccess(): bool
    {
        return Auth::check();
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('current_password')
                    ->label('Password saat ini')
                    ->password()
                    ->revealable()
                    ->prefixIcon('heroicon-o-lock-closed')
                    ->placeholder('Masukkan password saat ini')
                    ->required()
                    ->currentPassword(),

                TextInput::make('new_password')
                    ->label('Password baru')
                    ->password()
                    ->revealable()
                    ->prefixIcon('heroicon-o-key')
                    ->placeholder('Masukkan password baru')
                    ->required()
                    ->rule(Password::min(8)->numbers())
                    ->extraAttributes([
                        'x-model' => 'newPassword',
                        '@focus' => 'isFocused = true',
                        '@blur' => 'isFocused = false',
                    ]),

                TextInput::make('new_password_confirmation')
                    ->label('Konfirmasi password baru')
                    ->password()
                    ->revealable()
                    ->prefixIcon('heroicon-o-check-badge')
                    ->placeholder('Ulangi password baru')
                    ->required()
                    ->same('new_password'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);

        Notification::make()
            ->title('Password berhasil diperbarui')
            ->success()
            ->send();

        $this->form->fill();
    }
}