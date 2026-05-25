<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    try {

        view()->share('productCount', Product::count());

        view()->share('customerCount', Customer::count());

        view()->share(
            'balanceCount',
            Customer::with('ledger')->get()->map(function ($customer) {
                return $customer->ledger->sum('credit') - $customer->ledger->sum('debit');
            })->sum()
        );

        view()->share(
            'outstandingCount',
            Supplier::with('ledger')->get()->map(function ($supplier) {
                return $supplier->ledger->sum('debit') - $supplier->ledger->sum('credit');
            })->sum()
        );

    } catch (\Exception $e) {
        // Ignore database errors during deployment
    }
}
}
