<?php

namespace App\Filament\Resources\Tutors;

use App\Filament\Resources\Tutors\Pages\CreateTutor;
use App\Filament\Resources\Tutors\Pages\EditTutor;
use App\Filament\Resources\Tutors\Pages\ListTutors;
use App\Filament\Resources\Tutors\Schemas\TutorForm;
use App\Filament\Resources\Tutors\Tables\TutorsTable;
use App\Models\Tutor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TutorResource extends Resource
{
    protected static ?string $model = Tutor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    /**
     * Pengaturan Label untuk Sidebar, Header, & Breadcrumb dalam Bahasa Indonesia
     */
    protected static ?string $navigationLabel = 'Tutor';

    protected static ?string $modelLabel = 'Tutor';

    protected static ?string $pluralModelLabel = 'Tutor';

    protected static ?string $breadcrumb = 'Tutor';

    public static function canViewAny(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Hanya diizinkan untuk admin_cabang
        return $user?->hasRole('admin_cabang') ?? false;
    }

    /**
     * Membatasi query data Tutor hanya untuk cabang admin yang login
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && ! $user->hasRole('super_admin')) {
            $query->where('branch_id', $user->branch_id);
        }

        return $query;
    }

    public static function form(Schema $schema): Schema
    {
        return TutorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TutorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTutors::route('/'),
            'create' => CreateTutor::route('/create'),
            'edit' => EditTutor::route('/{record}/edit'),
        ];
    }
}