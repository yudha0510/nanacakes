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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->string('product_name');
            $table->string('product_image')->nullable();
            $table->integer('qty');
            $table->decimal('price', 12, 0);
            $table->decimal('subtotal', 12, 0);
            $table->boolean('use_candle')->default(false);
            $table->string('candle_1')->nullable();
            $table->string('candle_2')->nullable();
            $table->boolean('paper_bag')->default(false);
            $table->text('request_tambahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
