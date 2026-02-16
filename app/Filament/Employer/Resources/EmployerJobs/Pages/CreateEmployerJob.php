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
        // ربط الوظيفة بصاحب العمل الحالي تلقائياً
        $data['employer_id'] = Auth::user()->employer->id;
        return $data;
    }
}


