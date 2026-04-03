<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/Admin/user_resource.name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament/Admin/user_resource.email'))
                    ->searchable(),
                TextColumn::make('status')
                    ->label(__('filament/Admin/user_resource.status'))
                    ->label(__('filament/Admin/user_resource.status'))
                    ->badge()
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->label(__('filament/Admin/user_resource.email_verified_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('filament/Admin/user_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/Admin/user_resource.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
            ])

            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'all' => 'All',
                        'Admin' => 'Admin',
                        'JobSeeker' => 'JobSeeker',
                        'Employer' => 'Employer',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
