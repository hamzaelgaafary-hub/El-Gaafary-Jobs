<?php

namespace App\Filament\Resources\Jobs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use App\Enums\JobType;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;

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
                TextColumn::make('type')
                ->badge()
                ->sortable()
                ->searchable(),
                textColumn::make('tags.name')
                ->badge()
                ->sortable()
                ->searchable(),
                TextColumn::make('employer.name')
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                SelectFilter::make('employer_id')
                    ->relationship('employer', 'name'),
                SelectFilter::make('type')
                    ->options([
                        'all' => 'All',
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
                        return $query->when($data['created_from'], function (Builder $query, $date){
                            return $query->where('created_at', '>=', $date);
                        })
                        ->when($data['created_until'], function (Builder $query, $date){
                            return $query->where('created_at', '<=', $date);
                        });
                    }),

                Filter::make('updated_at')
                    ->schema([
                        DatePicker::make('updated_from'),
                        DatePicker::make('updated_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['updated_from'], function (Builder $query, $date){
                            return $query->where('updated_at', '>=', $date);
                        })
                        ->when($data['updated_until'], function (Builder $query, $date){
                            return $query->where('updated_at', '<=', $date);
                        });
                    }),

                TernaryFilter::make('Featured')
                    ->label('Featured')
                    ->placeholder('All Jobs')
                    ->trueLabel('Featured Only')
                    ->falseLabel('Not Featured'),

                ], layout:FiltersLayout::AboveContent)


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
