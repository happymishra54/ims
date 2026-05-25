<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Laravel can't modify columns easily unless DB driver supports it.
        // We do it in a safe way: drop and recreate customer_id as nullable.
        Schema::table('ledgers', function (Blueprint $table) {
            // Make customer_id nullable so supplier-ledger inserts won't fail
            // (Doctrine/dbal may be required for `change()`).
            $table->foreignId('customer_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ledgers', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable(false)->change();
        });
    }

};

