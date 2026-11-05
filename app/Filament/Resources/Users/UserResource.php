<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    /**
     * Label menu navigasi & model di Filament
     */
    protected static ?string $navigationLabel = 'Cabang';
    protected static ?string $modelLabel = 'Cabang';
    protected static ?string $pluralModelLabel = 'Cabang';

    /**
     * Group navigasi di sidebar
     */
    protected static string|UnitEnum|null $navigationGroup = 'MASTER DATA';

    /**
     * Membatasi akses menu Branches hanya untuk role Super Admin.
     */
    public static function canViewAny(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        return $user?->hasRole('super_admin') ?? false;
    }

    /**
     * Menyaring query agar hanya menampilkan user dengan role 'admin_cabang'
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->role('admin_cabang');
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table)
            ->searchable(false);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}