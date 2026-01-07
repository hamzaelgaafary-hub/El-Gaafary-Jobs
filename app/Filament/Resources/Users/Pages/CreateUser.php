<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
//use App\Filament\Resources\Users\Widgets\UserStats;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Users\Widgets\AdminStatsOverview;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    
}
