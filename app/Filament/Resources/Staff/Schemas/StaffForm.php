<?php

namespace App\Filament\Resources\Staff\Schemas;

use App\Models\Staff;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /* =======================
             | Identity
             ======================= */
            Section::make('Identity')
                ->description('Core staff identity information')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('designation'),
                        // ->required(),

                    TextInput::make('department')
                        ->columnSpanFull(),

                    TextInput::make('age')
                        ->numeric()
                        ->minValue(18)
                        ->maxValue(80),
                ]),

            /* =======================
             | Employment Information
             ======================= */
            Section::make('Employment Information')
                ->description('Company related details')
                ->columns(2)
                ->schema([
                    Select::make('employment_type')
                        ->options([
                            'Full-time' => 'Full-time',
                            'Part-time' => 'Part-time',
                            'Contract'  => 'Contract',
                            'Intern'    => 'Intern',
                        ]),

                    TextInput::make('years_in_company')
                        ->numeric()
                        ->minValue(0),

                    DatePicker::make('joining_date')
                        ->columnSpanFull(),
                ]),

            /* =======================
             | Skills
             ======================= */
            Section::make('Skills')
                ->description('Professional skills & expertise')
                ->schema([
                    TagsInput::make('skills')
                        ->placeholder('Laravel, React, DevOps')
                        ->columnSpanFull(),
                ]),

            /* =======================
             | Biography
             ======================= */
            Section::make('Biography')
                ->description('Detailed profile description')
                ->schema([
                    RichEditor::make('bio')
                        ->columnSpanFull(),
                ]),

            /* =======================
             | Contact Details
             ======================= */
            Section::make('Contact Details')
                ->description('Primary communication channels')
                ->columns(2)
                ->schema([
                    TextInput::make('email')->email(),
                    TextInput::make('phone'),

                    TextInput::make('whatsapp_number')
                        ->columnSpanFull(),
                ]),

            /* =======================
             | Social Links
             ======================= */
            Section::make('Social & Portfolio Links')
                ->description('Online presence')
                ->columns(2)
                ->schema([
                    TextInput::make('facebook_url')->url(),
                    TextInput::make('linkedin_url')->url(),

                    TextInput::make('github_url')->url(),
                    TextInput::make('portfolio_url')->url(),
                ]),

            /* =======================
             | Profile Image
             ======================= */
            Section::make('Profile Image')
                ->description('Square image recommended')
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('staff')
                        ->imageEditor()
                        ->imageCropAspectRatio('1:1')
                        ->maxSize(2048)
                        ->columnSpanFull(),
                ]),

            /* =======================
             | Visibility & Sorting
             ======================= */
            Section::make('Visibility & Sorting')
                ->description('Admin-only controls')
                ->visible(fn() => Auth::user()?->role === 'admin')
                ->columns(2)
                ->schema([
                    TextInput::make('position')
                        ->numeric()
                        ->minValue(1)
                        ->dehydrated(), // still saves to DB
                ]),
        ]);
    }
}
