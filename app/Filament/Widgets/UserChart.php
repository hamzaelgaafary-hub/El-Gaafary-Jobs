<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserChart extends ChartWidget
{
    protected ?string $heading = 'Users Chart';

    protected function getData(): array
    {
        $adminCount = User::where('status', 'admin')->count();
        $jobSeekerCount = User::where('status', 'JobSeeker')->count();
        $employerCount = User::where('status', 'employer')->count();

        return [
            'datasets' => [
                [
                    'label' => 'All Of Users',
                    'data' => [$adminCount, $jobSeekerCount, $employerCount],
                    'backgroundColor' => [
                        '#ef4444', // Red for Admin
                        '#3b82f6', // Blue for JobSeeker
                        '#f59e0b', // Amber for Employer
                    ],
                ],
            ],
            'labels' => ['Admin', 'Job Seeker', 'Employer'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
