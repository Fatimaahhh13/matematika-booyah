<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Branch;
use App\Models\Module;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class StudentDistribution extends Widget
{
    protected string $view = 'filament.widgets.student-distribution';

    protected int|string|array $columnSpan = 'full';

    public ?string $selectedLevel = 'all';
    public ?string $selectedBranch = 'all';

    public static function canView(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->hasRole('super_admin') ?? false;
    }

    public function getViewData(): array
    {
        // Pengaman awal jika tabel master cabang atau modul masih kosong melompong
        if (Branch::count() === 0) {
            return [
                'levelA' => 0,
                'levelB' => 0,
                'levelC' => 0,
                'allBranches' => collect(),
                'branches' => collect(),
            ];
        }
        // 1. Ambil daftar ID cabang yang valid/terdaftar di database
        $validBranchIds = Branch::pluck('id');

        // 2. Ambil daftar modul berdasarkan grade/level dari tabel modules secara dinamis
        $modulesA = Module::where('grade', 'LIKE', '%Level A%')->pluck('title');
        $modulesB = Module::where('grade', 'LIKE', '%Level B%')->pluck('title');
        $modulesC = Module::where('grade', 'LIKE', '%Level C%')->pluck('title');

        // Gabungkan semua modul valid untuk filter umum
        $allValidModules = $modulesA->merge($modulesB)->merge($modulesC);

        // 3. Hitung total siswa per level untuk data valid
        $countA = Student::whereIn('branch_id', $validBranchIds)
            ->whereIn('module', $modulesA)
            ->count();

        $countB = Student::whereIn('branch_id', $validBranchIds)
            ->whereIn('module', $modulesB)
            ->count();

        $countC = Student::whereIn('branch_id', $validBranchIds)
            ->whereIn('module', $modulesC)
            ->count();

        // 4. Mengambil daftar cabang
        $branchesData = Branch::all(); 

        // 5. Memetakan jumlah siswa per cabang secara sinkron dengan filter level dan modul valid
        $formattedBranches = $branchesData->map(function ($branch) use ($modulesA, $modulesB, $modulesC, $allValidModules) {
            $query = Student::where('branch_id', $branch->id);

            // Jika filter level dipilih pada dropdown atas
            if ($this->selectedLevel && $this->selectedLevel !== 'all') {
                if ($this->selectedLevel === 'A') {
                    $query->whereIn('module', $modulesA);
                } elseif ($this->selectedLevel === 'B') {
                    $query->whereIn('module', $modulesB);
                } elseif ($this->selectedLevel === 'C') {
                    $query->whereIn('module', $modulesC);
                }
            } else {
                // Jika "Semua Level", pastikan hanya menghitung siswa yang modulnya masuk kategori valid (A, B, atau C)
                $query->whereIn('module', $allValidModules);
            }

            return [
                'id' => $branch->id,
                'name' => $branch->name ?? 'Cabang Tanpa Nama',
                'count' => $query->count(),
            ];
        });

        // Filter daftar cabang jika dropdown cabang dipilih
        $filteredBranches = $formattedBranches;
        if ($this->selectedBranch && $this->selectedBranch !== 'all') {
            $filteredBranches = $formattedBranches->filter(function ($item) {
                return $item['id'] == $this->selectedBranch;
            });
        }

        $maxCount = $formattedBranches->max('count') ?: 1;

        $branchesWithPercentage = $filteredBranches->map(function ($item) use ($maxCount) {
            $percentage = min(100, max(8, ($item['count'] / $maxCount) * 100));
            $item['percentage'] = $item['count'] > 0 ? $percentage : 0;

            return $item;
        });

        return [
            'levelA' => $countA,
            'levelB' => $countB,
            'levelC' => $countC,
            'allBranches' => $branchesData, 
            'branches' => $branchesWithPercentage,
        ];
    }
}