<?php

namespace App\Filament\Employer\Resources\EmployerJobs\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class EmployerJobForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('filament/Employer/employer_job_resource.title'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->label(__('filament/Employer/employer_job_resource.url'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary')
                    ->label(__('filament/Employer/employer_job_resource.salary'))
                    ->prefix('$')
                    ->required()
                    ->maxLength(255),
                TextInput::make('location')
                    ->label(__('filament/Employer/employer_job_resource.location'))
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label(__('filament/Employer/employer_job_resource.type'))
                    ->options(['full_time' => __('filament/Employer/employer_job_resource.type.full_time'), 'part_time' => __('filament/Employer/employer_job_resource.type.part_time'), 'contract' => __('filament/Employer/employer_job_resource.type.contract'), 'internship' => __('filament/Employer/employer_job_resource.type.internship')])
                    ->label('Job Type')
                    ->required(),
                Select::make('Employer_id')
                    ->label(__('filament/Employer/employer_job_resource.employer_id'))
                    ->relationship(
                        name: 'Employer', // This must match the relationship method name on your current model
                        titleAttribute: 'name', // The column name you want to display in the dropdown
                        modifyQueryUsing: fn (Builder $query) => $query->where('user_id', Auth::id())
                    )
                    ->searchable()
                    ->preload()
                    ->default(__('filament/Employer/employer_job_resource.employer_id_default')),
                Select::make('Tags_id')
                    ->label(__('filament/Employer/employer_job_resource.tags_id'))
                    ->relationship('Tags', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->required(),
                TextInput::make('created_at')
                    ->label(__('filament/Employer/employer_job_resource.created_at'))
                    ->disabled()
                    ->dehydrated(),
                Radio::make('featured')
                    ->label(__('filament/Employer/employer_job_resource.featured'))
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
