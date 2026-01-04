<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Job;
use App\Models\Employer;
use App\Models\Category;
use App\Models\Location;
use App\Models\Company;
use App\Models\User;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Increased by ' . User::count()%10 . '%')
                ->descriptionIcon($this->getTrendingIcon(User::count(), 50))
                ->chart(range(1, User::count()))
                ->color('success'),
            
            Stat::make('Total Jobs', Job::count())
                ->description('Increased by 5%')
                ->descriptionIcon($this->getTrendingIcon(Job::count(), 10))
                ->chart(range(1, Job::count()))
                ->color('warning'),
            
            Stat::make('Total Featured Jobs', Job::where('featured', 1)->count())
                ->description('Increased by 0.3%')
                ->descriptionIcon($this->getTrendingIcon(Job::where('featured', 1)->count(), 5))
                ->chart(range(1, Job::where('featured', 1)->count()))
                ->color('primary'),
            
            Stat::make('Total Employers', Employer::count())
                ->description('Increased by 2%')
                ->descriptionIcon($this->getTrendingIcon(Employer::count(), 20))
                ->chart(range(1, Employer::count()))
                ->color('danger'),
        ];
    }

    private function getTrendingIcon(int $count, int $threshold): string
    {
        return $count >= $threshold ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
    }
}
