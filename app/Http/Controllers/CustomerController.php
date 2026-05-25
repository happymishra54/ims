<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Ledger;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.add_customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:customers,name',
            'phone' => 'nullable',
            'remarks' => 'nullable',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
        ]);
        $credit = $request->credit ?? 0;
        $debit = $request->debit ?? 0;
        $balance = $credit - $debit;
        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'remarks' => $request->remarks,
            'debit' => $request->debit,
            'credit' => $request->credit,
            'balance' => $balance,
        ]);
        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
        {
            $customer = Customer::findOrFail($id);

            $ledgers = Ledger::where('customer_id',$id)->orderBy('created_at','asc')->get();

            $runningBalance = Ledger::where('customer_id', $id)->sum('credit') - Ledger::where('customer_id', $id)->sum('debit');

            return view(
                'customer.show',
                compact(
                    'customer',
                    'ledgers',
                    'runningBalance',
                )
            );
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required|unique:customers,name,' . $id,
            'phone' => 'nullable',
            'remarks' => 'nullable',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
        ]);
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}
