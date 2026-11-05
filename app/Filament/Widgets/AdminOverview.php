<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class AdminOverview extends Widget
{
    protected string $view = 'filament.widgets.admin-overview';

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->hasRole('super_admin') ?? false;
    }

    public function getViewData(): array
    {
        return [
            'totalCabang' => User::role('admin_cabang')->count(),
            'totalTutor' => Tutor::count(),
            'totalSiswa' => Student::count(),
        ];
    }
}