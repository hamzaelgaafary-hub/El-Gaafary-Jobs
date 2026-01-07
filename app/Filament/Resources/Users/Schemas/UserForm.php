<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
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
                        'admin' => 'admin',
                        'JobSeeker' => 'JobSeeker',
                        'employer' => 'employer',
                    ])
                    ->required(),
                
                TextInput::make('Password')
                    ->password()
                    ->required(),
            ]);
    }
}
