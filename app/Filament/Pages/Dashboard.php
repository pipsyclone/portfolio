<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use BackedEnum;

use App\Livewire\Widgets\Visitors\VisitorChart;

class Dashboard extends BaseDashboard
{
    protected string|null $heading = 'Dashboard';
    public function getSubheading(): ?string
    {
        return __('Welcome to dashboard, ' . auth()->user()->name);
    }

    public function getWidgets(): array
    {
        return [
            VisitorChart::class,
            \App\Livewire\Widgets\Visitors\VisitorTable::class,
        ];
    }
}
