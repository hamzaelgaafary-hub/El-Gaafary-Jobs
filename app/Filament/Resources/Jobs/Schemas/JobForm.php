<?php

namespace App\Filament\Resources\Jobs\Schemas;

use App\Models\Employer;
use Doriiaan\FilamentAstrotomic\Schemas\Components\TranslatableTabs;
use Doriiaan\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                    ->label(__('filament/Admin/job_resource.location'))
                    ->maxLength(255),

                Select::make('type')
                    ->label(__('filament/Admin/job_resource.type'))
                    ->translateLabel()
                    ->options(['full_time' => __('filament/Admin/job_resource.type.full_time'), 'part_time' => __('filament/Admin/job_resource.type.part_time'), 'contract' => __('filament/Admin/job_resource.type.contract'), 'internship' => __('filament/Admin/job_resource.type.internship')])
                    ->label('Job Type')
                    ->required(),
                Select::make('Employer_id')
                    ->label(__('filament/Admin/job_resource.employer_id'))
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->options(
                        Employer::all()->pluck('name', 'id')
                    )
                    ->preload(),

                // Non-Translated Fields
                TextInput::make('url')
                    ->label(__('filament/Admin/job_resource.url'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary')
                    ->label(__('filament/Admin/job_resource.salary'))
                    ->prefix('$')
                    ->required()
                    ->maxLength(255),
                Select::make('Tags_id')
                    ->label(__('filament/Admin/job_resource.tags_id'))
                    ->relationship('Tags', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->required(),
                TextInput::make('created_at')
                    ->label(__('filament/Admin/job_resource.created_at'))
                    ->disabled()
                    ->dehydrated(),
                Radio::make('featured')
                    ->label(__('filament/Admin/job_resource.featured'))
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
