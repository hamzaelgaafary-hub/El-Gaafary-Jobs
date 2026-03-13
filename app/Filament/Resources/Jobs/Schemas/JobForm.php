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
                    ->required(), //  to Only strict on the primary language add ->required($tab->isMainLocale())
                
                    Textarea::make($tab->makeName('description'))
                        ->label('Job Description')
                        ->required($tab->isMainLocale()),
            
                    ])->columnSpanFull(),

                    TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                    

                    Select::make('type')
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

                        // Configure create action - https://filamentphp.com/docs/4.x/forms/select#creating-a-new-option-in-a-modal
                        ->createOptionModalHeading('Create')
                        ->createOptionForm(fn (Schema $schema) => EmployerForm::configure($schema))
                        ->createOptionUsing(function (array $data) {
                            $optionRecord = Employer::create($data);

                            return $optionRecord->id;
                        })
                        // Configure edit action - https://filamentphp.com/docs/4.x/forms/select#editing-the-selected-option-in-a-modal
                        ->editOptionModalHeading('Edit')
                        ->editOptionForm(fn (Schema $schema) => EmployerForm::configure($schema))
                        ->fillEditOptionActionFormUsing(function (string $state) {
                            if (!$state) {
                                return [];
                            }

                            $optionRecord = Employer::find($state);

                            return EmployerResource::mutateTranslatableData($optionRecord, $optionRecord->attributesToArray());
                        })
                        ->updateOptionUsing(function (array $data, string $state) {
                            $optionRecord = Employer::find($state);

                            $optionRecord->update($data);

                            return $optionRecord->id;
                        })
                        ->preload(),
                    
                /*
                    
                */

                // Non-Translated Fields
                TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary')
                    ->prefix('$')
                    ->required()
                    ->maxLength(255),
                    /*
                Select::make('Employer_id')
                    ->relationship('Employer', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                    */
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
