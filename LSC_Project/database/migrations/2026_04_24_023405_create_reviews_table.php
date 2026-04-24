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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->foreignId('user_id')
                ->constrained('users', 'user_id') 
                ->cascadeOnDelete();
            $table->foreignId('order_id')
                ->constrained('orders', 'order_id')
                ->cascadeOnDelete();
            $table->unsignedTinyInteger('rating'); 
            $table->text('comment')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->unique('order_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
