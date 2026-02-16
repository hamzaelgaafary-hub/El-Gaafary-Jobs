<?php

namespace App\Filament\Resources\Employers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EmployersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->sortable()
                ->searchable(),
                TextColumn::make('logo')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')
                ->sortable()
                ->searchable(),
                
                TextColumn::make('created_at')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User'),
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
