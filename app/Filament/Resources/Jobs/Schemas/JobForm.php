<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Schemas\Schema;
use App\Models\Employer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

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
                ->required()
            ]);
    }
}
