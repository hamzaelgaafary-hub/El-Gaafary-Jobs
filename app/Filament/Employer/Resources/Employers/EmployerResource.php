<?php

namespace App\Filament\Employer\Resources\Employers;

use App\Filament\Employer\Resources\Employers\Pages\CreateEmployer;
use App\Filament\Employer\Resources\Employers\Pages\EditEmployer;
use App\Filament\Employer\Resources\Employers\Pages\ListEmployers;
use App\Filament\Employer\Resources\Employers\Pages\ViewEmployer;
use App\Filament\Employer\Resources\Employers\Schemas\EmployerForm;
use App\Filament\Employer\Resources\Employers\Schemas\EmployerInfolist;
use App\Filament\Employer\Resources\Employers\Tables\EmployersTable;
use App\Models\Employer;
use BackedEnum;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class EmployerResource extends Resource
{
    //    use Translatable;
    protected static ?string $model = Employer::class;

    protected static ?string $navigationLabel = null;

    protected static ?string $modelLabel = null;

    protected static ?string $pluralModelLabel = null;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Profile Management';

    public static function form(Schema $schema): Schema
    {
        return EmployerForm::configure($schema);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['Employer_id'] = Auth::user()->Employer->id;

        return $data;
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployersTable::configure($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', Auth::id()));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployers::route('/'),
            'create' => CreateEmployer::route('/create'),
            'view' => ViewEmployer::route('/{record}'),
            'edit' => EditEmployer::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/Employer/employer_resource.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament/Employer/employer_resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/Employer/employer_resource.plural_model_label');
    }
}
