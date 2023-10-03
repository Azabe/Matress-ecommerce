<?php

namespace App\Http\Controllers\Admin;

use App\Charts\DistrictsOrdersChart;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\DashboardServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Charts\ProductsSoldChart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(ProductsSoldChart $productsSoldChart, DistrictsOrdersChart $districtsOrdersChart)
    {
        return (new DashboardServices)->getDashboardOverview($productsSoldChart,$districtsOrdersChart);
    }
}
