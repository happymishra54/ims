<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function updateMargin(Request $request, string $id)
    {
        $request->validate([
            'margin' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $marginPercent = (float) $request->margin;

        $product->margin = $marginPercent;
        $bought = (float) $product->bought_price;
        $product->selling_price = $bought + ($bought * $marginPercent / 100);
        $product->save();

        return redirect()->route('product.index')->with('success', 'Margin updated successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        // $productCount = $products->count();
        // $customers= Customer::all();
        // $customerCount = Customer::count();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('product.add_product', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'remarks' => 'nullable',
            'bought_price' => 'nullable|numeric',
            'selling_price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'unit' => 'nullable|string',
        ]);
        $marginPercent = $request->margin ?? 10;
        $selling_price = $request->bought_price + ($request->bought_price * $marginPercent / 100);
        product::create([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'bought_price' => $request->bought_price,
            'margin' => $request->margin,
            'selling_price' => $selling_price,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
        ]);
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product= Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'remarks' => 'nullable',
            'bought_price' => 'nullable|numeric',
            'margin' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'unit' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        $data = $request->all();

        // Recalculate selling_price like add_product whenever bought_price (or margin) changes
        $marginPercent = $request->filled('margin') ? (float) $request->margin : (float) ($product->margin ?? 0);
        $bought = $request->filled('bought_price') ? (float) $request->bought_price : (float) ($product->bought_price ?? 0);

        $data['margin'] = $marginPercent;
        $data['bought_price'] = $bought;
        $data['selling_price'] = $bought + ($bought * $marginPercent / 100);

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', "%$search%")->get();
        return view('product.index', compact('products'));
    }

    


}
