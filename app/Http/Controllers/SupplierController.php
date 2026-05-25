<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('supplier.add', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'remarks' => 'nullable',
            'phone' => 'nullable',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
        ]);
        $credit = $request->input('credit', 0);
        $debit = $request->input('debit', 0);
        $balance = $debit - $credit;
        Supplier::create([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'phone' => $request->phone,
            'debit' => $debit,
            'credit' => $credit,
            'balance' => $balance,
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $ledgers = \App\Models\Ledger::where('supplier_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Supplier context: running balance should be debit - credit (same as running calculation).
        $runningBalance = \App\Models\Ledger::where('supplier_id', $id)->sum('debit')
            - \App\Models\Ledger::where('supplier_id', $id)->sum('credit');

        return view('supplier.show', compact('supplier', 'ledgers', 'runningBalance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier= Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'remarks' => 'nullable',
            'phone' => 'nullable',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
    }
}
