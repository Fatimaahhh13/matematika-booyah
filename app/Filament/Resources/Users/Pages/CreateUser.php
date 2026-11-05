<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Branch;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // Judul utama halaman
    protected static ?string $title = 'Tambah Cabang';

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

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data cabang baru berhasil ditambahkan.');
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $branchInput = $data['cabang'] ?? $data['branch_id'] ?? null;

        if (!empty($branchInput)) {
            if (is_string($branchInput)) {
                $branch = Branch::firstOrCreate(
                    ['name' => trim($branchInput)]
                );
                $data['branch_id'] = $branch->id;
            } else {
                $data['branch_id'] = $branchInput;
            }
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        /** @var \App\Models\User $record */
        $record = $this->record;

        if (!$record->hasRole('admin_cabang')) {
            $record->assignRole('admin_cabang');
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}