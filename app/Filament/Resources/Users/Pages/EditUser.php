<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // Judul utama halaman
    protected static ?string $title = 'Edit Cabang';

    // Teks breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Edit';
    }

    // Menjadikan lebar halaman Edit penuh sama seperti halaman List
    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data cabang berhasil diperbarui.');
    }

    // Label tombol "Save Changes"
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan Perubahan');
    }

    // Label tombol "Cancel"
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Data Cabang')
                ->modalDescription('Apakah Anda yakin ingin menghapus data cabang ini? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Batal'),
        ];
    }

    // Mengarahkan kembali ke halaman daftar (Index/Tabel) setelah data diperbarui
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}