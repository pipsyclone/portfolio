<?php

namespace App\Livewire\Widgets\Visitors;

use Filament\Widgets\ChartWidget;

class VisitorChart extends ChartWidget
{
    protected ?string $heading = 'Visitor Chart';
    protected ?string $description = "Overview of visitor statistics in the system.";
    protected ?string $pollingInterval = '10s';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $count = \App\Models\Visitor::where('visited_date', $date)->count();
            
            $data[] = $count;
            $labels[] = now()->subDays($i)->format('M d');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Unique Visitors',
                    'data' => $data,
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
