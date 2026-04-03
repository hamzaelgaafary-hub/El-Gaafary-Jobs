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
                    ->label(__('filament/Admin/user_resource.name'))
                    ->unique()
                    ->required(),
                TextInput::make('email')
                    ->label(__('filament/Admin/user_resource.email'))
                    ->email(),
                Select::make('status')
                    ->label(__('filament/Admin/user_resource.status'))
                    ->options(['Admin' => __('filament/Admin/user_resource.status.admin'), 'JobSeeker' => __('filament/Admin/user_resource.status.job_seeker'), 'Employer' => __('filament/Admin/user_resource.status.employer')])
                    ->required(),

                TextInput::make('Password')
                    ->label(__('filament/Admin/user_resource.password'))
                    ->password()
                    ->required(),
            ]);
    }
}
