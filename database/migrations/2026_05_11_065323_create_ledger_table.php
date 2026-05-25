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
        Schema::create('ledgers', function (Blueprint $table) {

            $table->id();
        
            $table->foreignId('customer_id');
        
            $table->decimal('credit',10,2)
                  ->default(0);
        
            $table->decimal('debit',10,2)
                  ->default(0);
        
            $table->string('remarks')
                  ->nullable();
        
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledger');
    }
};
