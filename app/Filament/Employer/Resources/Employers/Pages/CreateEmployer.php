<?php

namespace App\Filament\Employer\Resources\Employers\Pages;

use App\Filament\Employer\Resources\Employers\EmployerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateEmployer extends CreateRecord
{
    protected static string $resource = EmployerResource::class;

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        return $data;
    }
 
}
