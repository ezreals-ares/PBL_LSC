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
            $table->id();
            $table
                ->foreignId('order_id')
                ->unique()
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->date('payment_date')->nullable();
            $table->decimal('amount', 10, 2);
            $table
                ->enum('payment_method', [
                    'transfer',
                    'e_wallet',
                    'cash',
                    'qris',
                ])
                ->nullable();
            $table
                ->enum('status', ['pending', 'completed', 'failed'])
                ->default('pending');
            $table->string('proof_image')->nullable();
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
