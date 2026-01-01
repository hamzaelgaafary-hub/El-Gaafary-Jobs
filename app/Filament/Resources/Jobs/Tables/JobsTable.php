<?php

namespace App\Filament\Resources\Jobs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class JobsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->sortable()
                ->searchable(),
                TextColumn::make('salary')
                ->money('USD')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('location')
                ->sortable()
                ->searchable(),
                TextColumn::make('type')
                ->badge()
                ->sortable()
                ->searchable(),
                TextColumn::make('employer.name')
                ->sortable()
                ->searchable(),
                textColumn::make('status')

            ])
            ->filters([
                //
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
