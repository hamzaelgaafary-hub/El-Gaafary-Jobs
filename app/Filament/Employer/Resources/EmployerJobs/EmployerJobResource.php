<?php

namespace App\Filament\Employer\Resources\EmployerJobs;

use App\Filament\Employer\Resources\EmployerJobs\Pages\CreateEmployerJob;
use App\Filament\Employer\Resources\EmployerJobs\Pages\EditEmployerJob;
use App\Filament\Employer\Resources\EmployerJobs\Pages\ListEmployerJobs;
use App\Filament\Employer\Resources\EmployerJobs\Schemas\EmployerJobForm;
use App\Filament\Employer\Resources\EmployerJobs\Tables\EmployerJobsTable;
use App\Models\Job;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmployerJobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return EmployerJobForm::configure($schema);
    }
    /*
        public static function getEloquentQuery(): Builder
        {
            return parent::getEloquentQuery()
                ->whereHas('employer', fn ($q) =>
                    $q->where('user_id', Auth::user()->id)
                );
        }
    */
    public static function getEloquentQuery(): Builder
    {
        // عرض الوظائف التي يملكها هذا المستخدم فقط
        return parent::getEloquentQuery()->where('employer_id', auth::user()->employer?->id);
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
}
