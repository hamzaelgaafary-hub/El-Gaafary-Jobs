<?php

namespace App\Filament\Employer\Resources\EmployerJobs\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class EmployerJobForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary')
                    ->prefix('$')
                    ->required()
                    ->maxLength(255),
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
                ->relationship(
                        name: 'employer', // This must match the relationship method name on your current model
                        titleAttribute: 'name', // The column name you want to display in the dropdown
                        modifyQueryUsing: fn (Builder $query) => $query->where('user_id', auth::id())
                    )                    
                    ->searchable()
                    ->preload()
                    ->default(Auth::user()->Employer->id),
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
