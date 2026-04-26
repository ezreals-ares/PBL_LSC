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
         Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->date('order_date');
            $table
                ->enum('pickup_method', ['pickup', 'drop_off'])
                ->default('drop_off');
            $table
                ->enum('status', [
                    'pending',
                    'confirmed',
                    'processing',
                    'ready_for_pickup',
                    'picked_up',
                    'cancelled',
                ])
                ->default('pending');
            $table->date('estimated_finish')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
