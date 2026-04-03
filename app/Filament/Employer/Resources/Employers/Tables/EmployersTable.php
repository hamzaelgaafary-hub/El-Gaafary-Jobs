<?php

namespace App\Filament\Employer\Resources\Employers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('filament/Employer/employer_resource.user.name'))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('filament/Employer/employer_resource.name'))
                    ->searchable(),
                TextColumn::make('logo')
                    ->label(__('filament/Employer/employer_resource.logo'))
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('filament/Employer/employer_resource.description'))
                    ->searchable(),
                TextColumn::make('website')
                    ->label(__('filament/Employer/employer_resource.website'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament/Employer/employer_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/Employer/employer_resource.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
