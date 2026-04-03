<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Doriiaan\FilamentAstrotomic\Schemas\Components\TranslatableTabs;
use Doriiaan\FilamentAstrotomic\TranslatableTab;
use App\Filament\Resources\EmployerResource;
use App\Models\Employer;
use App\Filament\Resources\Jobs\Schemas\EmployerForm;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

// use App\Filament\Resources\Jobs\Schemas\ModelTableSelect;

class JobForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Translated Fields (Inside Tabs)
            TranslatableTabs::make()
                ->localeTabSchema(fn (TranslatableTab $tab) => [
                    TextInput::make($tab->makeName('title'))
                        ->label('Job Title')
                        ->translateLabel()
                        ->required(), //  to Only strict on the primary language add ->required($tab->isMainLocale())
                    Textarea::make($tab->makeName('description'))
                        ->label('Job Description')
                        ->required($tab->isMainLocale()),
                ])->columnSpanFull(),

                TextInput::make('location')
                    ->required()
                    ->translateLabel()
                    ->label('Location')
                    ->maxLength(255),
                
                Select::make('type')
                    ->translateLabel()
                    ->options([
                        'full_time' => 'Full Time',
                        'part_time' => 'Part Time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ])
                    ->label('Job Type')
                    ->required(),
                Select::make('Employer_id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->options(
                        Employer::all()->pluck('name', 'id')
                    )
                    ->preload(),

                // Non-Translated Fields
                TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary')
                    ->prefix('$')
                    ->required()
                    ->maxLength(255),
                Select::make('Tags_id')
                    ->relationship('Tags', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->required(),
                TextInput::make('created_at')
                    ->label('Created At')
                    ->disabled()
                    ->dehydrated(),
                Radio::make('featured')
                    ->label('Featured')
                    ->options([
                        true => 'Featured',
                        false => 'Not featured',
                    ])
                    ->descriptions([
                        true => 'Job will be featured on the homepage.',
                        false => 'Job will not be featured on the homepage.',
                    ])
                    ->default(false),
            ]);
    }
}
