<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Cabang';

    protected string $view = 'filament.resources.users.list-users';

    public string $search = '';

    public function getTitle(): string
    {
        return 'Cabang';
    }

    // Mengubah teks breadcrumb menjadi "Daftar"
    public function getBreadcrumb(): string
    {
        return 'Daftar';
    }

    public function getTableSearchable(): bool
    {
        return false;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    // Mengambil data record KHUSUS untuk akun cabang dengan aman
    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        // 1. FILTER MUTLAK: Sembunyikan Super Admin, Admin Pusat, dan Tutor
        // Sesuaikan kata kunci di bawah ini dengan nama role atau string penanda di database Anda
        $query->where(function ($q) {
            $q->where('name', 'not like', '%Super Admin%')
              ->where('name', 'not like', '%Tutor%')
              ->where('email', 'not like', '%superadmin%')
              ->where('email', 'not like', '%tutor%');
              // Tambahkan kondisi lain jika diperlukan, contoh: ->where('role', 'cabang')
        });

        // 2. FITUR PENCARIAN TEKS
        if (filled($this->search)) {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('email', 'like', $searchTerm)
                  ->orWhere('cabang', 'like', $searchTerm);
            });
        }

        return $query;
    }
}