<?php

namespace App\Filament\Employer\Resources\EmployerJobs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EmployerJobsTable
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
                    ->alignEnd()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('type')
                    ->options([
                        'full_time' => 'Full Time',
                        'part_time' => 'Part Time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ])
                    ->label('Job Type')
                    ->searchable(),
                TextColumn::make('Tags.name')
                    ->alignEnd()
                    ->sortable()
                    ->badge()
                    ->label('Tags')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Employer.name')
                    ->label('Employer Name')
                    ->sortable()
                    ->openUrlInNewTab()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('location')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'full_time' => 'Full Time',
                        'part_time' => 'Part Time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ])
                    ->label('Job Type'),
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['created_from'], function (Builder $query, $date) {
                            return $query->where('created_at', '>=', $date);
                        })
                            ->when($data['created_until'], function (Builder $query, $date) {
                                return $query->where('created_at', '<=', $date);
                            });
                    }),
                Filter::make('updated_at')
                    ->schema([
                        DatePicker::make('updated_from'),
                        DatePicker::make('updated_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['updated_from'], function (Builder $query, $date) {
                            return $query->where('updated_at', '>=', $date);
                        })
                            ->when($data['updated_until'], function (Builder $query, $date) {
                                return $query->where('updated_at', '<=', $date);
                            });
                    }),
                TernaryFilter::make('Featured')
                    ->label('Featured')
                    ->placeholder('All Jobs')
                    ->trueLabel('Featured Only')
                    ->falseLabel('Not Featured'),
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
