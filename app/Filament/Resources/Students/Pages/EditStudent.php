<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;
use Filament\Notifications\Notification;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;

    // Memperlebar tampilan halaman Edit agar membentang penuh
    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    // Mengarahkan kembali ke halaman list student setelah berhasil memperbarui data
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Data Siswa')
                ->modalDescription('Apakah Anda yakin ingin menghapus data siswa ini? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Batal'),
        ];
    }

    // Mengubah judul notifikasi sukses saat data berhasil diperbarui ke Bahasa Indonesia
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data siswa berhasil diperbarui.');
    }

    // Mengubah teks tombol Save di halaman edit
    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan Perubahan');
    }

    // Mengubah teks tombol Cancel di halaman edit
    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }
}