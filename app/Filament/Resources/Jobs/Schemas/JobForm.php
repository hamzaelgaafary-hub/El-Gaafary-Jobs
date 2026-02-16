<?php
namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Schemas\Schema;
use App\Models\Employer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TernaryInput;
use Filament\Forms\Components\Radio;
use App\Filament\Tables\EmployersTable;
//use App\Filament\Resources\Jobs\Schemas\ModelTableSelect;
use Filament\Forms\Components\ModelTableSelect;
use Filament\Tables\Table;



class JobForm
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
                ->relationship('Employer', 'name')
                ->searchable()
                ->preload()
                ->required(),
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
                   false => 'Not featured'
                ])
                ->descriptions([
                    true => 'Job will be featured on the homepage.',
                    false => 'Job will not be featured on the homepage.'
                ])
                ->default(false),
            ]);
    }
}
