<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'remarks',
        'debit',
        'credit',
        'balance',
    ];

        public function ledger()
        {
            return $this->hasMany(Ledger::class);
        }
}
