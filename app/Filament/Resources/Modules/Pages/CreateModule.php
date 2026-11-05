<?php

namespace App\Filament\Resources\Modules\Pages;

use App\Filament\Resources\Modules\ModuleResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateModule extends CreateRecord
{
    protected static string $resource = ModuleResource::class;

    // Judul utama halaman
    protected static ?string $title = 'Tambah Modul';

    // Memperlebar tampilan halaman Create agar penuh ke samping
    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    // Teks breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Tambah';
    }

    // Mengarahkan kembali ke halaman daftar (List/Index) setelah modul berhasil dibuat
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Modul baru berhasil ditambahkan.');
    }

    // Label tombol "Create"
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    // Label tombol "Create & create another"
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Buat Lagi');
    }

    // Label tombol "Cancel"
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }
}