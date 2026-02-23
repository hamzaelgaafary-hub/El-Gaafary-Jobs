<?php

namespace App\Filament\Employer\Resources\EmployerJobs;

use App\Filament\Employer\Resources\EmployerJobs\Pages\CreateEmployerJob;
use App\Filament\Employer\Resources\EmployerJobs\Pages\EditEmployerJob;
use App\Filament\Employer\Resources\EmployerJobs\Pages\ListEmployerJobs;
use App\Filament\Employer\Resources\EmployerJobs\Schemas\EmployerJobForm;
use App\Filament\Employer\Resources\EmployerJobs\Tables\EmployerJobsTable;
use App\Models\Employer;
use App\Models\Job;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class EmployerJobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = null;

    public static function getNavigationLabel(): string
    {
        return Auth::user()->name."'s Jobs";
    }

    public static function form(Schema $schema): Schema
    {
        return EmployerJobForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployerJobsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployerJobs::route('/'),
            'create' => CreateEmployerJob::route('/create'),
            'edit' => EditEmployerJob::route('/{record}/edit'),
        ];
    }
    /*
    public static function canCreate(): bool
    {
        return Auth::check() && Auth::user()->can('create_jobs');
    }

    public static function canEdit($record): bool
    {
        return Auth::check() && Auth::user()->can('edit_jobs') &&
               $record->Employer_id === Auth::user()->Employer->id;
    }

    public static function canDelete($record): bool
    {
        return Auth::check() && Auth::user()->can('delete_jobs') &&
               $record->Employer_id === Auth::user()->Employer->id;
    }
    */
}
