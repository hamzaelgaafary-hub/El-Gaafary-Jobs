<?php

namespace App\Filament\Resources\Jobs\Pages;

use App\Filament\Resources\Jobs\JobResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\AdminStatsOverview;
use App\Filament\Resources\Jobs\Widgets\JobStats;

class ListJobs extends ListRecords
{
    protected static string $resource = JobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getHeaderWidgets(): array
    {
        return [
           JobStats::class,
        ];
    }
    public function getFooterWidgets(): array
    {
        return [
           AdminStatsOverview::class,
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
