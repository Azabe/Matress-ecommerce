<?php

namespace App\Http\Controllers\Admin;

use App\Charts\DistrictsOrdersChart;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\DashboardServices;
use Illuminate\Contracts\View\View;
use App\Charts\ProductsSoldChart;

class HomeController extends Controller
{
    public function index(ProductsSoldChart $productsSoldChart, DistrictsOrdersChart $districtsOrdersChart): View
    {
        return (new DashboardServices)->getDashboardOverview($productsSoldChart, $districtsOrdersChart);
    }
}
