<?php

namespace App\Filament\Resources\TeachingSessions\Pages;

use App\Filament\Resources\TeachingSessions\TeachingSessionResource;
use App\Models\TeachingSession;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ListTeachingSessions extends ListRecords
{
    protected static string $resource = TeachingSessionResource::class;

    protected string $view = 'filament.resources.teaching-sessions.header';

    // Properti publik untuk menangkap input pencarian dari Blade
    public $search = '';

    public ?string $selectedMonth = null;

    protected function getTableQuery(): ?Builder
    {
        $query = TeachingSession::query();

        // 1. Logika Pencarian Teks (Hanya berdasarkan Nama Siswa dan Modul)
        if (filled($this->search)) {
            $searchTerm = '%' . trim($this->search) . '%';
            
            $query->where(function (Builder $q) use ($searchTerm) {
                // Cari berdasarkan Nama Siswa (relasi student)
                $q->whereHas('student', function (Builder $studentQuery) use ($searchTerm) {
                    $studentQuery->where('name', 'like', $searchTerm);
                })
                // Atau cari berdasarkan Judul Modul (relasi module)
                ->orWhereHas('module', function (Builder $moduleQuery) use ($searchTerm) {
                    $moduleQuery->where('title', 'like', $searchTerm);
                });
            });
        }

        // 2. Logika Filter Bulan (Bisa aktif bersamaan dengan pencarian teks)
        if (!empty($this->selectedMonth)) {
            $query->whereMonth('session_date', $this->selectedMonth);
        }

        return $query;
    }

    public function getAvailableMonthsProperty(): array
    {
        return \App\Models\TeachingSession::query()
            ->whereNotNull('session_date')
            ->orderBy('session_date', 'asc')
            ->pluck('session_date')
            ->map(fn($date) => Carbon::parse($date))
            ->unique(fn($date) => $date->format('Y-m'))
            ->mapWithKeys(fn($date) => [$date->format('m') => $date->englishMonth . ' ' . $date->year])
            ->toArray();
    }

    public function getTitle(): string
    {
        return 'Progress';
    }

    public function getBreadcrumb(): string
    {
        return 'Daftar';
    }

    protected function getHeaderActions(): array
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user?->hasRole('tutor')) {
            return [
                CreateAction::make()->label('Add Session'),
            ];
        }

        return [];
    }
}