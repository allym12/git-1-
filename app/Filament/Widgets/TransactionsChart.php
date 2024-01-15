<?php

namespace App\Filament\Widgets;

use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TransactionsChart extends BarChartWidget
{
    protected static ?string $heading = 'Recent successful transactions today';
    protected int | string | array $columnSpan = 'full';



    protected function getData(): array
    {
        $data = Trend::query(PaymentTransaction::query()
            ->where('status', '1')
        )
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth()
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Transactions made',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => [
                        'rgba(0, 1, 80, 1)',
                        'rgba(0, 1, 80, 1)',
                    ],

                    'borderColor' => [
                        '#4c51bf',
                    ],
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::make($value->date)->format('M')),
        ];
    }





}
