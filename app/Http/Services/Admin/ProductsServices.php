<?php

namespace App\Http\Services\Admin;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsServices
{
    public function getAllProducts(): View
    {
        $products = Product::get();
        return view('admin.products.index', compact('products'));
    }

    public function createNewProduct(): View
    {
        return view('admin.products.create');
    }

    public function storeNewProduct(Request $request): RedirectResponse
    {
        $uploadedImage = $request->file('image');
        $image = $this->saveImage($uploadedImage);
        $newProduct = [
            'id' => Str::uuid()->toString(),
            'size' => $request->size,
            'type' => $request->type,
            'image' => $image,
            'description' => $request->description,
            'length' => $request->length,
            'height' => $request->height,
            'width' => $request->width,
            'price' => $request->price,
            'quantity' => $request->quantity
        ];

        Product::create($newProduct);
        return redirect()->route('admin.products.index')->with('success', 'New product has been created successfully');
    }

    public function deleteSoldProduct(string $productId)
    {
        $productToDelete = Product::find($productId);
        $this->deleteImage($productToDelete->image);
        $productToDelete->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product has been deleted successfully');
    }

    public function saveImage(object $uploadedImage): string
    {
        $filename = time() . '_' . Str::random(8) . '.' . $uploadedImage->getClientOriginalExtension();
        $finalFile = $uploadedImage->storeAs(date('YF'), $filename, 'public');
        return $finalFile;
    }

    public function deleteImage(string $image): void
    {
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }
}
