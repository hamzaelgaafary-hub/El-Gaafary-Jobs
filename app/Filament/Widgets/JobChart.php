<?php

namespace App\Filament\Widgets;

use App\Models\Job;
use DateTime;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class JobChart extends ChartWidget
{
    protected ?string $heading = 'Jobs Chart';

    protected function getFilters(): ?array
{
    return [
        'today' => 'Today',
        'week' => 'Last week',
        'month' => 'Last month',
        'year' => 'This year',
    ];
}

    protected function getData(): array
    {


        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $data = Trend::model(Job::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $featuredData = Trend::query(Job::where('featured', true))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

    return [
        'datasets' => [
            [
                'label' => 'Total Jobs',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'borderColor' => '#2176ffff', // Optional custom color
            ],
            
            [
                'label' => 'Total Featured Jobs',
                'data' => $featuredData->map(fn (TrendValue $value) => $value->aggregate),
                'borderColor' => '#00dbf8ff', // Optional custom color
            ],
               
        ],

        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    
    }

    
    protected function getType(): string
    {
        return 'line';
    }
}
