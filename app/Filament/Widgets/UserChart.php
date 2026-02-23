<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected ?string $heading = 'Users Chart';

    protected function getData(): array
    {
        $AdminCount = User::where('status', 'Admin')->count();
        $jobSeekerCount = User::where('status', 'JobSeeker')->count();
        $EmployerCount = User::where('status', 'Employer')->count();

        return [
            'datasets' => [
                [
                    'label' => 'All Of Users',
                    'data' => [$AdminCount, $jobSeekerCount, $EmployerCount],
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
