<?php

namespace App\Filament\Resources\Staff;

use App\Filament\Resources\Staff\Pages\CreateStaff;
use App\Filament\Resources\Staff\Pages\EditStaff;
use App\Filament\Resources\Staff\Pages\ListStaff;
use App\Filament\Resources\Staff\Schemas\StaffForm;
use App\Filament\Resources\Staff\Tables\StaffTable;
use App\Models\Staff;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user';
    protected static string|UnitEnum|null $navigationGroup = 'Users';

    /* =========================
     | Access Control
     ========================= */

    public static function canViewAny(): bool
    {
        return Auth::check();
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return true;
        }

        return $record->user_id === $user->id;
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->role === 'admin';
    }

    /* =========================
     | Query Restriction
     ========================= */

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        // Admin → see all staff
        if ($user->role === 'admin') {
            return $query;
        }

        // User → see ONLY own staff profile
        return $query->where('user_id', $user->id);
    }

    /* =========================
     | Form & Table
     ========================= */

    public static function form(Schema $schema): Schema
    {
        return StaffForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StaffTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListStaff::route('/'),
            'create' => CreateStaff::route('/create'),
            'edit'   => EditStaff::route('/{record}/edit'),
        ];
    }

    /* =========================
     | Auto attach logged-in user
     ========================= */

    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }
}
