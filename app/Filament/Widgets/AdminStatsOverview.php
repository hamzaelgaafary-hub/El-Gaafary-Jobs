<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Job;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdminStatsOverview extends StatsOverviewWidget
{
    public ?Model $record = null;

    public static function canViewForRecord($record, string $pageClass): bool
    {
        // Add your authorization logic here
        return true; // or your custom logic
    }
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
            
        ];
    }

    private function getTrendingIcon(int $count, int $threshold): string
    {
        return $count >= $threshold ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
    }
}
