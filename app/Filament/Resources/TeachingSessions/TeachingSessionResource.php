<?php

namespace App\Filament\Resources\TeachingSessions;

use App\Filament\Resources\TeachingSessions\Pages\ListTeachingSessions;
use App\Filament\Resources\TeachingSessions\Schemas\TeachingSessionForm;
use App\Filament\Resources\TeachingSessions\Tables\TeachingSessionsTable;
use App\Models\TeachingSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TeachingSessionResource extends Resource
{
    protected static ?string $model = TeachingSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Progress';

    protected static ?string $modelLabel = 'Progress';

    protected static ?string $pluralModelLabel = 'Progress';

    protected static ?string $breadcrumb = 'Progress';

    /**
     * Hanya tampil di sidebar untuk Admin Cabang
     */
    public static function shouldRegisterNavigation(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->hasRole('admin_cabang') ?? false;
    }

    /**
     * Hak akses penuh halaman Progress hanya untuk Admin Cabang
     */
    public static function canViewAny(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->hasRole('admin_cabang') ?? false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && ! $user->hasRole('super_admin')) {
            $branchId = $user->branch_id;

            // Memfilter data progress berdasarkan cabang tutor yang mengajar
            $query->whereHas('tutor', function (Builder $q) use ($branchId) {
                $q->where('branch_id', $branchId);
            });
        }

        return $query;
    }

    public static function form(Schema $schema): Schema
    {
        return TeachingSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeachingSessionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeachingSessions::route('/'),
        ];
    }
}