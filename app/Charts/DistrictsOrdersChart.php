<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class DistrictsOrdersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $residencesNames = [];
        $residencesOrders = [];
        $residences = User::join('orders', 'users.id', '=', 'orders.user_id')
            ->groupBy('users.residence')
            ->select('users.residence', DB::raw('COUNT(*) as order_count'))
            ->orderByDesc('order_count')
            ->get();
        foreach ($residences as $residence) {
            $residencesNames[] = $residence->residence;
            $residencesOrders[] = $residence->order_count;
        }
        return $this->chart->pieChart()
            ->setTitle('Orders By District')
            ->setSubtitle('')
            ->addData($residencesOrders)
            ->setLabels($residencesNames);
    }
}
