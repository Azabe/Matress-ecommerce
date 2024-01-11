<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\ProductsServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductsController extends Controller
{
    public function index(): View
    {
        return (new ProductsServices)->getAllProducts();
    }

    public function create(): View
    {
        return (new ProductsServices)->createNewProduct();
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'size' => 'required',
            'type' => 'required',
            'image' => 'required',
            'description' => 'required',
            'length' => 'required',
            'quantity' => 'required',
            'height' => 'required',
            'width' => 'required',
            'price' => 'required'
        ]);

        return (new ProductsServices)->storeNewProduct($request);
    }

    public function destroy(string $productId): RedirectResponse
    {
        return (new ProductsServices)->deleteSoldProduct($productId);
    }

    

    public function generatePdf(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    
    $tableData = $this->buildTableData($startDate, $endDate);

    $pdf = PDF::loadView('admin.products.reports', [
        'tableData' => $tableData,
        'startDate' => $startDate,
        'endDate' => $endDate,
    ]);
    
    return $pdf->stream();
}


    public function buildTableData($startDate = null, $endDate = null)
{

    if ($startDate && $endDate) {
        $products = Product::whereHas('orders', function ($query) use ($startDate, $endDate) {
            $query->where('status', Order::APPROVED)
                ->whereBetween('orders.created_at', [$startDate, $endDate]);
        })
        ->join('order__products', 'products.id', '=', 'order__products.product_id')
        ->select('products.id', 'products.title', DB::raw('SUM(order__products.quantity) as total_ordered_quantity'))
        ->groupBy('products.id', 'products.title')
        ->orderByDesc('total_ordered_quantity')
        ->get();

        $tableData = [];
        foreach ($products as $product) {
            $tableData[] = [
                'id' => $product->id,
                'title' => $product->title,
                'total_ordered_quantity' => $product->total_ordered_quantity,
            ];
        }
    }

    return $tableData;
}

public function update(Request $request, $id)
{
    
    $product = Product::findOrFail($id);
    $product->quantity = $request->input('new_quantity');
    $product->save();

    return redirect()->back()->with('success', 'Product updated successfully');
}

}
