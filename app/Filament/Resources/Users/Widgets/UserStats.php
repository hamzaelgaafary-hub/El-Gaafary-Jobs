<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Total Users Count is '.User::count())
                ->descriptionIcon('heroicon-m-user-group')
                ->chart(range(1, User::count()))
                ->color('warning'),
            Stat::make('Total Admins', User::where('status', 'Admin')->count())
                ->description('Total Admins Count is '.User::where('status', 'Admin')->count())
                ->descriptionIcon('heroicon-m-users')
                ->chart(range(1, User::where('status', 'Admin')->count()))
                ->color('success'),
            Stat::make('Total Job Seekers', User::where('status', 'JobSeeker')->count())
                ->description('Total Job Seekers Count is '.User::where('status', 'JobSeeker')->count())
                ->descriptionIcon('heroicon-m-users')
                ->chart(range(1, User::where('status', 'JobSeeker')->count()))
                ->color('success'),
            Stat::make('Total Employers', User::where('status', 'Employer')->count())
                ->description('Total Employers Count is '.User::where('status', 'Employer')->count())
                ->descriptionIcon('heroicon-m-users')
                ->chart(range(1, User::where('status', 'Employer')->count()))
                ->color('success'),

        ];
    }
}
