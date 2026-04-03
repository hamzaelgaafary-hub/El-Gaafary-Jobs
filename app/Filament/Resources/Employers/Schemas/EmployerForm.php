<?php

namespace App\Filament\Resources\Employers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/Admin/employer_resource.name'))
                    ->required()
                    ->unique()
                    ->translateLabel()
                    ->maxLength(255),
                TextInput::make('logo')
                    ->label(__('filament/Admin/employer_resource.logo'))
                    ->required()
                    ->maxLength(255),
                Select::make('user_id')
                    ->label(__('filament/Admin/employer_resource.user_id'))
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
