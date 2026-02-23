<?php

namespace App\Filament\Resources\Jobs\Pages;

use App\Filament\Resources\Jobs\JobResource;
use App\Filament\Resources\Jobs\Widgets\JobStats;
use App\Filament\Widgets\AdminStatsOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
