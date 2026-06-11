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
        Schema::create('payments', function (Blueprint $table) {
        $table->id('payment_id');
        $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnDelete();
        $table->date('payment_date')->nullable();
        $table->decimal('amount', 10, 2);
        $table->enum('payment_method', ['e-wallet', 'bank-transfer'])->default('Bank Transfer');
        $table->enum('status', ['verified', 'unverified'])->default('unverified');
        $table->string('payment_proof')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
