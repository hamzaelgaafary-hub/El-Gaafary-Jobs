<?php

namespace App\Filament\Resources\Jobs\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Job;

class JobStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Jobs', Job::count())
                ->description('Total Jobs Count is ' . Job::count())
                ->descriptionIcon('heroicon-m-briefcase')
                ->chart(range(1, Job::count()))
                ->color('primary'),
            Stat::make('Total Featured Jobs', Job::where('featured', true)->count())
                ->description('Total Featured Jobs Count is ' . Job::where('featured', true)->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart(range(1, Job::where('featured', true)->count()))
                ->color('success'),
            Stat::make('Total UnFeatured Jobs', Job::where('featured', false)->count())
                ->description('Total UnFeatured Jobs Count is ' . Job::where('featured', false)->count())
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart(range(1, Job::where('featured', false)->count()))
                ->color('warning'),
            
            Stat::make('Total Full time Jobs', Job::where('type', 'Full Time')->count())
                ->description('Total Full time Jobs Count is ' . Job::where('type', 'Full Time')->count())
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart(range(1, Job::where('type', 'Full Time')->count()))
                ->color('warning'),
            
            
        ];
    }
}
