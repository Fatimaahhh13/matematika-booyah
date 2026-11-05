<?php

namespace App\Filament\Resources\Tutors\Pages;

use App\Filament\Resources\Tutors\TutorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditTutor extends EditRecord
{
    protected static string $resource = TutorResource::class;

    // Judul halaman utama
    protected static ?string $title = 'Edit Tutor';

    // Memperlebar tampilan halaman Edit agar membentang penuh ke samping
    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    // Teks breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Edit';
    }

    // Mengarahkan kembali ke halaman daftar tutor setelah data berhasil diperbarui
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data tutor berhasil diperbarui.');
    }

    // Label tombol "Save Changes"
    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan Perubahan');
    }

    // Label tombol "Cancel"
    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Mengambil data name dan email dari relasi user untuk dimunculkan di form edit
        $record = $this->getRecord();
        if ($record->user) {
            $data['name'] = $record->user->name;
            $data['email'] = $record->user->email;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Hapus konfirmasi password agar tidak ikut diproses sebagai kolom database
        unset($data['password_confirmation']);

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            // 1. Perbarui data pada tabel users terkait
            if ($record->user) {
                $userData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ];

                // Update password hanya jika kolom password diisi oleh admin
                if (!empty($data['password'])) {
                    $userData['password'] = $data['password'];
                }

                $record->user->update($userData);
            }

            // 2. Perbarui data pada tabel tutors
            $record->update([
                'phone' => $data['phone'] ?? $record->phone,
                'avatar' => $data['avatar'] ?? $record->avatar,
                'status' => $data['status'] ?? $record->status,
            ]);

            return $record;
        });
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Data Tutor')
                ->modalDescription('Apakah Anda yakin ingin menghapus data tutor ini? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Batal'),
        ];
    }
}