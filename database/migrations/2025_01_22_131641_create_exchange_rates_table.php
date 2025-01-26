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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Date of the exchange rate
            $table->foreignId('currency_id')
                    ->nullable()
                    ->constrained();
            $table->decimal('buying_rate', 10, 2); // Buying rate for 100 foreign currency
            $table->decimal('selling_rate', 10, 2); // Selling rate for 100 foreign currency
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
