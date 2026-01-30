<?php

namespace App\Filament\Resources\Blogs;

use App\Filament\Resources\Blogs\Pages\CreateBlog;
use App\Filament\Resources\Blogs\Pages\EditBlog;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Filament\Resources\Blogs\Schemas\BlogForm;
use App\Filament\Resources\Blogs\Tables\BlogsTable;
use App\Models\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencilSquare;


    // Use custom query to restrict normal users
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        // Admin → see all blogs
        if ($user?->role === 'admin') {
            return $query;
        }

        // Non-admin → only own blogs
        return $query->where('staff_id', $user->staff?->id ?? 0);
    }

    // Form configuration
    public static function form(Schema $schema): Schema
    {
        return BlogForm::configure($schema);
    }

    // Table configuration
    public static function table(Table $table): Table
    {
        // Add author column in table dynamically
        return BlogsTable::configure($table)
            ->columns(array_merge(
                BlogsTable::configure($table)->getColumns(),
                [
                    // Author name
                    \Filament\Tables\Columns\TextColumn::make('staff.user.name')
                        ->label('Author')
                        ->sortable()
                        ->searchable(),
                ]
            ));
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
            'index' => ListBlogs::route('/'),
            'create' => CreateBlog::route('/create'),
            'edit' => EditBlog::route('/{record}/edit'),
        ];
    }
}
