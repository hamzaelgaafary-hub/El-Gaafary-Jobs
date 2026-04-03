<?php

namespace App\Filament\Employer\Resources\EmployerJobs\Pages;

use App\Filament\Employer\Resources\EmployerJobs\EmployerJobResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmployerJobs extends ListRecords
{
    protected static string $resource = EmployerJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

        ];
    }

    public function getTitle(): string
    {
        return __('filament/Employer/list_employer_jobs.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/Employer/list_employer_jobs.title');
    }
}
