<?php

namespace App\Filament\Employer\Resources\Employers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Schema;

class EmployerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(Auth::user()->id)
                    ->required()
                    ->disabled()
                    ->helperText('The User associated with this Employer.'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->helperText('The name of the Employer.'),
                TextInput::make('logo')
                    ->required()
                    ->url()
                    ->helperText('URL of the Employer logo.'),
                TextInput::make('description')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->helperText('A brief Description of The Employer.'),
                TextInput::make('website')
                    ->url(),     
            ]);
    }
}
