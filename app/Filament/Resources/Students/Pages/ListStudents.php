<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected string $view = 'filament.resources.students.list-students';

    // Variabel publik untuk menangkap input pencarian dari Blade header kustom
    public $search = '';

    public function getTitle(): string
    {
        return 'Siswa';
    }

    // Mengubah teks breadcrumb "List" menjadi "Daftar"
    public function getBreadcrumb(): string
    {
        return 'Daftar';
    }

    protected function getTableSearchable(): bool
    {
        return false;
    }

    /**
     * Memfilter kueri tabel siswa berdasarkan branch_id user yang login dan kata kunci pencarian
     */
    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Jika yang login bukan super_admin, saring datanya sesuai branch_id
        if ($user && ! $user->hasRole('super_admin')) {
            $query->where('branch_id', $user->branch_id);
        }

        // Logika pencarian kustom berdasarkan Nama Siswa, Sekolah, atau Modul
        if (filled($this->search)) {
            $searchTerm = '%' . trim($this->search) . '%';
            
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('school', 'like', $searchTerm)
                  ->orWhere('module', 'like', $searchTerm);
            });
        }

        return $query;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}