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
        Schema::create('operational_hours', function (Blueprint $table) {
            $table->id('operational_id');
            $table->foreignId('outlet_id')->constrained('outlets', 'outlet_id')->cascadeOnDelete();
            $table->enum('day', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']);
            $table->time('open_time');
            $table->time('close_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operational_hours');
    }
};
