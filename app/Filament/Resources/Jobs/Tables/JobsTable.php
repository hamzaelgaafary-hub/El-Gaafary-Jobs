<?php

namespace App\Filament\Resources\Jobs\Tables;

use App\Filament\Resources\EmployerResource;
use App\Models\Job;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Tabs\Tab;
use App\Filament\Resources\Jobs\JobResource;

class JobsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('translations.title')
                    ->label('Job Title')
                    ->sortable(query: function ($query, string $direction) {
                        // الترتيب حسب الترجمة يحتاج Join أو استخدام ميزة المكتبة
                        $query->orderByTranslation('title', $direction);
                    })    // بيعرض أول لغة بس عشان الزحمة
                    ->searchable(query: function ($query, string $search) {
                        // البحث في الترجمات باستخدام ميزة Astrotomic
                        $query->whereTranslationLike('title', "%{$search}%");
                    }),
                
                TextColumn::make('translations.description') // Plural 'translations'
                    ->label('Job Description'),
                        
                SelectColumn::make('type')
                    ->options([
                        'full_time' => 'Full Time',
                        'part_time' => 'Part Time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ])
                    ->label('Job Type')
                    ->searchable(),
                TextColumn::make('location')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('Tags.name')
                    ->alignEnd()
                    ->sortable()
                    ->badge()
                    ->label('Tags')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Employer.name')
                    ->label('Employer Name')
                    // ->url(fn (job $record):string => EmployerResource::getUrl('edit', ['record' => $record->Employer_id]))
                    ->sortable()
                    ->searchable()
                    ->openUrlInNewTab()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('salary')
                    ->money('USD')
                    ->sortable()
                    ->alignEnd()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])


            ->filters([
                SelectFilter::make('Employer_id')
                    ->relationship('Employer', 'name'),
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
                EditAction::make()->mutateRecordDataUsing(function (Job $record, array $data) {
                    return JobResource::mutateTranslatableData($record, $data);
                })->mutateDataUsing(function (Job $record, array $data) {
                    $record->unsetRelation('translation');
                    return $data;
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
