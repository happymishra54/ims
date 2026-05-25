<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'remarks',
        'phone',
        'debit',
        'credit',
        'balance',
    ];

    public function ledger()
    {
        return $this->hasMany(Ledger::class, 'supplier_id');
    }
}
