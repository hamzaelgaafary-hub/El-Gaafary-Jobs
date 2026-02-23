<?php

namespace App\Filament\Employer\Resources\EmployerJobs\Pages;

use App\Filament\Employer\Resources\EmployerJobs\EmployerJobResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployerJob extends CreateRecord
{
    protected static string $resource = EmployerJobResource::class;
}
