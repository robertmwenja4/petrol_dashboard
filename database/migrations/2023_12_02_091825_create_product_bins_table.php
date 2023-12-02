<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_bins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('shift_id')->default(0);
            $table->unsignedBigInteger('transaction_id')->default(0);
            $table->unsignedDecimal('opening_stock', 16, 4);
            $table->unsignedDecimal('stock_in', 16, 4);
            $table->unsignedDecimal('stock_out', 16, 4);
            $table->unsignedDecimal('closing_stock', 16, 4);
            $table->enum('type', ['purchase','stock_adjustment','stock_movement']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_bins');
    }
}
