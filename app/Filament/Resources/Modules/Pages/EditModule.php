<?php

namespace App\Filament\Resources\Modules\Pages;

use App\Filament\Resources\Modules\ModuleResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditModule extends EditRecord
{
    protected static string $resource = ModuleResource::class;

    // Judul utama halaman
    protected static ?string $title = 'Edit Modul';

    // Memperlebar tampilan halaman Edit agar penuh ke samping
    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    // Teks breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Edit';
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data modul berhasil diperbarui.');
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
                ->modalHeading('Hapus Modul')
                ->modalDescription('Apakah Anda yakin ingin menghapus modul ini? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Batal'),
        ];
    }

    /**
     * Mengatur agar setelah tombol Simpan Perubahan diklik, 
     * halaman otomatis kembali ke daftar modul (index).
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}