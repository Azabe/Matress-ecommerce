<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class OrdersController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')->with('products')->get();
        return view('admin.orders.index', compact('orders'));
    }


    // public function orderPdf(Request $request)
    // {
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');
        
    //     $residencesNames = [];
    //     $residencesOrders = [];
        
    //     // Fetch chart data with date range
    //     $residences = User::join('orders', 'users.id', '=', 'orders.user_id')
    //         ->whereBetween('orders.created_at', [$start_date, $end_date])
    //         ->groupBy('users.residence')
    //         ->select('users.residence', DB::raw('COUNT(*) as order_count'))
    //         ->orderByDesc('order_count')
    //         ->get();
        
    //     foreach ($residences as $residence) {
    //         $residencesNames[] = $residence->residence;
    //         $residencesOrders[] = $residence->order_count;
    //     }
    
    //     // Create and return the PDF with the chart data and date range
    //     $pdf = PDF::loadView('admin.orders.reports', [
    //         'residencesNames' => $residencesNames,
    //         'residencesOrders' => $residencesOrders,
    //         'start_date' => $start_date,
    //         'end_date' => $end_date,
    //     ]);
    
    //     return $pdf->stream();
    // }    

    public function orderPdf(Request $request)
     {
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    
    // Call the existing build method with date range parameters
    $tableData = $this->buildTableData($startDate, $endDate);

    // Create and return the PDF with the table and date range
    $pdf = PDF::loadView('admin.orders.reports', [
        'tableData' => $tableData,
        'startDate' => $startDate,
        'endDate' => $endDate,
    ]);
    
    return $pdf->stream();
}

public function buildTableData($startDate = null, $endDate = null)
{

    if ($startDate && $endDate) {
        $products = User::join('orders', 'users.id', '=', 'orders.user_id')
        ->whereBetween('orders.created_at', [$startDate, $endDate])
        ->groupBy('users.residence')
        ->select('users.residence', DB::raw('COUNT(*) as order_count'))
        ->orderByDesc('order_count')
        ->get();
    
        $tableData = [];
        foreach ($products as $product) {
            $tableData[] = [
             
                'residence' => $product->residence,
                'order_count' => $product->order_count,
               
            ];
        }
    }
    return $tableData;
}
}
