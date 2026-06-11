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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');

            $table->foreignId('product_id');

            $table->integer('qty')->default(1);

            $table->boolean('use_candle')->default(false);

            $table->string('candle_1')->nullable();

            $table->string('candle_2')->nullable();

            $table->boolean('paper_bag')->default(false);

            $table->text('request_tambahan')->nullable();

            $table->decimal('price', 12, 0);

            $table->decimal('subtotal', 12, 0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
