<?php

namespace App\Filament\Resources\Tutors\Pages;

use App\Filament\Resources\Tutors\TutorResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTutors extends ListRecords
{
    protected static string $resource = TutorResource::class;

    protected string $view = 'filament.resources.tutors.header-style';

    // Menangkap inputan dari wire:model.live.debounce.500ms="search" di Blade kustom
    public $search = '';

    public function getTitle(): string
    {
        return 'Tutor';
    }

    public function getBreadcrumb(): string
    {
        return 'Daftar';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    // Mengatur query tabel agar hanya mencari berdasarkan nama dan email
    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if (filled($this->search)) {
            $query->whereHas('user', function (Builder $userQuery) {
                $userQuery->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        return $query;
    }
}