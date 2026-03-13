<?php

namespace App\Filament\Resources\Jobs\Pages;

use App\Filament\Resources\Jobs\JobResource;
use Filament\Resources\Pages\CreateRecord;
use Doriiaan\FilamentAstrotomic\Resources\Pages\CreateTranslatable;


class CreateJob extends CreateRecord
{
    use CreateTranslatable;
    protected static string $resource = JobResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
