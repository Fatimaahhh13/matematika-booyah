<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\TeachingSession;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Jika tutor mencoba buka dashboard, langsung alihkan (redirect) ke halaman input-sesi
        if ($user && $user->hasRole('tutor')) {
            redirect()->to('/admin/input-sesi')->send();
            return false;
        }

        return true;
    }

    public static function shouldRegisterNavigation(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && $user->hasRole('tutor')) {
            return false;
        }

        return true;
    }

    public function mount(): void
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && $user->hasRole('tutor')) {
            return;
        }
    }

    public function getViewData(): array
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && ($user->hasRole('admin_cabang') || $user->hasRole('admin-cabang'))) {
            $branchId = $user->branch_id ?? null;

            $studentQuery = $branchId ? Student::where('branch_id', $branchId) : Student::query();
            $tutorQuery = $branchId ? Tutor::where('branch_id', $branchId) : Tutor::query();
            $sessionQuery = $branchId ? TeachingSession::whereHas('tutor', fn($q) => $q->where('branch_id', $branchId)) : TeachingSession::query();

            $totalSiswa = (clone $studentQuery)->count();
            $totalTutor = (clone $tutorQuery)->count();
            $totalSesi  = (clone $sessionQuery)->count();

            // Menghitung jumlah siswa berdasarkan relasi grade pada tabel modules
            $levelA = (clone $studentQuery)->whereIn('module', \App\Models\Module::where('grade', 'Level A')->pluck('title'))->count();
            $levelB = (clone $studentQuery)->whereIn('module', \App\Models\Module::where('grade', 'Level B')->pluck('title'))->count();
            $levelC = (clone $studentQuery)->whereIn('module', \App\Models\Module::where('grade', 'Level C')->pluck('title'))->count();

            return [
                'totalSiswa' => $totalSiswa,
                'totalTutor' => $totalTutor,
                'totalSesi'  => $totalSesi,
                'levelA'     => $levelA,
                'levelB'     => $levelB,
                'levelC'     => $levelC,
                'maxLevel'   => max(100, $totalSiswa),
            ];
        }

        // Untuk Super Admin / Global
        $allA = Student::whereIn('module', \App\Models\Module::where('grade', 'Level A')->pluck('title'))->count();
        $allB = Student::whereIn('module', \App\Models\Module::where('grade', 'Level B')->pluck('title'))->count();
        $allC = Student::whereIn('module', \App\Models\Module::where('grade', 'Level C')->pluck('title'))->count();
        
        $totalSiswaAll = Student::count();
        $totalTutorAll = Tutor::count();
        $totalSesiAll  = TeachingSession::count();

        return [
            'totalSiswa' => $totalSiswaAll,
            'totalTutor' => $totalTutorAll,
            'totalSesi'  => $totalSesiAll,
            'levelA'     => $allA,
            'levelB'     => $allB,
            'levelC'     => $allC,
            'maxLevel'   => max(100, $totalSiswaAll),
        ];
    }

    public function getView(): string
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (! $user) {
            return parent::getView();
        }

        if ($user->hasRole('admin_cabang') || $user->hasRole('admin-cabang')) {
            return 'filament.pages.branch-dashboard';
        }

        return 'filament.pages.dashboard';
    }

    public function getWidgets(): array
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && ! $user->hasRole('super_admin') && ! $user->hasRole('super-admin')) {
            return [];
        }

        return parent::getWidgets();
    }
}