<?php

namespace App\Http\Controllers\CustomerCare;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Services\CustomerCare\OrdersServices;

class OrdersController extends Controller
{
    public function index(): View
    {

        return (new OrdersServices)->getAllPendingOrders();
    }
}
