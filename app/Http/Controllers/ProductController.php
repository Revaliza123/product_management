<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12); // Menampilkan 10 produk per halaman
        return view('Product', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'production_date' => 'required|date',
            'expired_date' => 'required|date',
            'quantity' => 'required|number'
        ]);
        
        Product::create($request->all());
        return redirect('products');
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'production_date' => 'required|date',
            'expired_date' => 'required|date',
            'quantity' => 'required|number'
        ]);

        $product->update($request->all());
        return redirect('products');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products');
    }
}
