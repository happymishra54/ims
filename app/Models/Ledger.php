<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


    protected $fillable = [
        'customer_id',
        'supplier_id',
        'credit',
        'debit',
        'remarks',
    ];
}
