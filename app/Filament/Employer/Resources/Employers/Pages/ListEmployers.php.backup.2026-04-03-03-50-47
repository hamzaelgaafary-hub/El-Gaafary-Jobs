<?php

namespace App\Filament\Employer\Resources\Employers\Pages;

use App\Filament\Employer\Resources\Employers\EmployerResource;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;

class ListEmployers extends ListRecords
{
    protected static string $resource = EmployerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
