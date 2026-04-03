<?php

namespace App\Filament\Employer\Resources\Employers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('filament/Employer/employer_resource.user_id'))
                    ->relationship('user', 'name')
                    ->default(__('filament/Employer/employer_resource.user_id_default'))
                    ->required()
                    ->disabled()
                    ->helperText('The User associated with this Employer.'),
                TextInput::make('name')
                    ->label(__('filament/Employer/employer_resource.name'))
                    ->required()
                    ->maxLength(255)
                    ->helperText('The name of the Employer.'),
                TextInput::make('logo')
                    ->label(__('filament/Employer/employer_resource.logo'))
                    ->required()
                    ->url()
                    ->helperText('URL of the Employer logo.'),
                TextInput::make('description')
                    ->label(__('filament/Employer/employer_resource.description'))
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->helperText('A brief Description of The Employer.'),
                TextInput::make('website')
                    ->label(__('filament/Employer/employer_resource.website'))
                    ->url(),
            ]);
    }
}
