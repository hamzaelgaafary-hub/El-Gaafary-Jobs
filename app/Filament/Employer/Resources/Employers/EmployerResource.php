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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmployerResource extends Resource
{
    protected static ?string $model = Employer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return EmployerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        // المستخدم يرى فقط سجل شركتة الخاصة
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    // إخفاء زر "إنشاء" و "حذف" لأن السجل يُنشأ تلقائياً عبر الـ Observer
    public static function canCreate(): bool { return false; }
    public static function canDelete($record): bool { return false; }
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
