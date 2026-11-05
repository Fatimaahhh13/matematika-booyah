<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    // Mengubah judul halaman utama (heading) menjadi "Tambah Siswa"
    protected static ?string $title = 'Tambah Siswa';

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    // Mengubah teks pada breadcrumb agar tidak "Create" melainkan "Tambah"
    public function getBreadcrumb(): string
    {
        return 'Tambah';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Jika yang login bukan super_admin, wajibkan mengisi branch_id sesuai cabang user tersebut
        if ($user && ! $user->hasRole('super_admin')) {
            if (empty($user->branch_id)) {
                throw new \Exception('Akun Anda belum memiliki branch_id. Harap hubungi Super Admin.');
            }
            
            $data['branch_id'] = $user->branch_id;
        }

        return $data;
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
            ->body('Data siswa berhasil ditambahkan.');
    }

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Buat Lagi');
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }
}