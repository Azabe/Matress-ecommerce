<?php

namespace App\Charts;

use App\Models\Order;
use App\Models\Product;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ProductsSoldChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $productNames = [];
        $orderedQuantities = [];

        $products = Product::whereHas('orders', function ($query) {
            $query->where('status', Order::APPROVED);
        })
            ->join('order__products', 'products.id', '=', 'order__products.product_id')
            ->select('products.id', 'products.title', DB::raw('SUM(order__products.quantity) as total_ordered_quantity'))
            ->groupBy('products.id', 'products.title')
            ->orderByDesc('total_ordered_quantity')
            ->get();
        foreach ($products as $product) {
            $productNames[] = $product->title;
            $orderedQuantities[] = intval($product->total_ordered_quantity);
        }
        $data = [
            'productNames' => $productNames,
            'orderedQuantities' => $orderedQuantities,
        ];
        return $this->chart->pieChart()
            ->setTitle('Orders quantity Per Product')
            ->setSubtitle('')
            ->addData($orderedQuantities)
            ->setLabels($productNames);
    }

    public function product_report(){
        
    }
}
