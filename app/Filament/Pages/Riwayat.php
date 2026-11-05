<?php

namespace App\Filament\Pages;

use App\Models\TeachingSession;
use App\Models\Tutor;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Riwayat extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-m-clock';
    protected static ?string $navigationLabel = 'Riwayat';
    protected static ?string $title = 'Riwayat';
    protected string $view = 'filament.pages.riwayat';

    // Properti publik untuk menangkap input pencarian dan filter bulan
    public $search = '';
    public ?string $selectedMonth = null;

    // Mengatur agar halaman memenuhi seluruh lebar layar secara responsif
    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->hasRole('tutor') ?? false;
    }

    /**
     * Menambahkan breadcrumb kustom agar tampil di atas halaman
     */
    public function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Riwayat',
            'Daftar',
        ];
    }

    /**
     * Mengambil daftar bulan secara dinamis berdasarkan data sesi tutor yang login
     */
    public function getAvailableMonthsProperty(): array
    {
        $tutor = Tutor::where('user_id', Auth::id())->first();
        $tutorId = $tutor?->id ?? Auth::id();

        $sessions = TeachingSession::query()
            ->where('tutor_id', $tutorId)
            ->whereNotNull('session_date')
            ->orderBy('session_date', 'desc')
            ->pluck('session_date');

        $months = [];
        foreach ($sessions as $dateString) {
            if ($dateString) {
                $date = Carbon::parse($dateString);
                $ym = $date->format('Y-m'); // Format YYYY-MM untuk pencocokan filter
                $months[$ym] = $date->translatedFormat('F Y');
            }
        }

        return array_unique($months);
    }

    public function table(Table $table): Table
    {
        $tutor = Tutor::where('user_id', Auth::id())->first();
        $tutorId = $tutor?->id ?? Auth::id();

        return $table
            ->searchable(false)
            ->query(function () use ($tutorId) {
                $query = TeachingSession::query()
                    ->where('tutor_id', $tutorId);

                // 1. Logika Pencarian Teks (Berdasarkan Nama Siswa dan Modul)
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
                    $query->whereRaw("DATE_FORMAT(session_date, '%Y-%m') = ?", [$this->selectedMonth]);
                }

                return $query;
            })
            ->columns([
                TextColumn::make('session_date')
                    ->label('Tanggal')
                    ->date('d F Y')
                    ->sortable(),

                TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->sortable(),

                TextColumn::make('module.title')
                    ->label('Modul')
                    ->default('-'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'selesai', 'hadir' => 'success',
                        'belum selesai', 'izin' => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('notes')
                    ->label('Catatan')
                    ->limit(50)
                    ->default('-'),
            ])
            ->paginated([5, 10, 25, 50]);
    }
}