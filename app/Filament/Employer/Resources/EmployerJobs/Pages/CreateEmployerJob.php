<?php

namespace App\Filament\Employer\Resources\EmployerJobs\Pages;

use App\Filament\Employer\Resources\EmployerJobs\EmployerJobResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateEmployerJob extends CreateRecord
{
    protected static string $resource = EmployerJobResource::class;



    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['Employer_id'] = Auth::user()->Employer->id;
        return $data;
    }
}
