<?php

namespace App\Filament\Employer\Resources\Employers\Pages;

use App\Filament\Employer\Resources\Employers\EmployerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployer extends ViewRecord
{
    protected static string $resource = EmployerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('filament/Employer/view_employer.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/Employer/view_employer.title');
    }
}
