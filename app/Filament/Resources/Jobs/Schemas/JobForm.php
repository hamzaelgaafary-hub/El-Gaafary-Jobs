<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Schemas\Schema;
use App\Models\Employer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                TextInput::make('featured')
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
                TextInput::make('type')
                ->required()
                ->maxLength(255),

               Select::make('employer_id')
                ->relationship('employer', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Select::make('tags_id')
                ->relationship('tags', 'name')
                ->searchable()
                ->preload()
                ->multiple(),
            ]);
    }
}
