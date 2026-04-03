<?php

namespace App\Filament\Employer\Resources\Employers\Pages;

use App\Filament\Employer\Resources\Employers\EmployerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEmployer extends EditRecord
{
    protected static string $resource = EmployerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('filament/Employer/edit_employer.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/Employer/edit_employer.title');
    }
}
