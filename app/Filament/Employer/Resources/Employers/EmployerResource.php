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
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;

class EmployerResource extends Resource
{
//    use Translatable;
    protected static ?string $model = Employer::class;
    protected static ?string $navigationLabel = 'My Profiles';
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
        ->modifyQueryUsing(fn (Builder $query) 
            => $query->where('user_id', auth::id()));  
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
}
