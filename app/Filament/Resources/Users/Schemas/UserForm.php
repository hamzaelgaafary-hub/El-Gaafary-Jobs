<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->unique()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Select::make('status')
                    ->options([
                        'Admin' => 'Admin',
                        'JobSeeker' => 'JobSeeker',
                        'Employer' => 'Employer',
                    ])
                    ->required(),

                TextInput::make('Password')
                    ->password()
                    ->required(),
            ]);
    }
}
