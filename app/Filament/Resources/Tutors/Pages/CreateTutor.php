<?php

namespace App\Filament\Resources\Tutors\Pages;

use App\Filament\Resources\Tutors\TutorResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateTutor extends CreateRecord
{
    protected static string $resource = TutorResource::class;

    // Judul halaman utama
    protected static ?string $title = 'Tambah Tutor';

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    // Teks breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Tambah';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data tutor berhasil ditambahkan.');
    }

    // Label tombol "Create"
    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    // Label tombol "Create & create another"
    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Buat Lagi');
    }

    // Label tombol "Cancel"
    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['password_confirmation']);

        /** @var \App\Models\User|null $currentUser */
        $currentUser = Auth::user();

        if ($currentUser && !$currentUser->hasRole('super_admin')) {
            $data['branch_id'] = $currentUser->branch_id;
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // 1. Buat data user di tabel users terlebih dahulu
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'branch_id' => $data['branch_id'] ?? null,
            ]);

            if (method_exists($user, 'assignRole')) {
                $user->assignRole('tutor');
            }

            // 2. Buat data tutor di tabel tutors dan masukkan id user ke kolom user_id
            $tutor = static::getModel()::create([
                'user_id' => $user->id,
                'branch_id' => $data['branch_id'] ?? null,
                'avatar' => $data['avatar'] ?? null,
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'] ?? 'aktif',
            ]);

            return $tutor;
        });
    }
}