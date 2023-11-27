<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCloseShiftItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_shift_items', function (Blueprint $table) {
            // 'user_id','pump_id','product_id','nozzle_id','product_price','balance','amount',
            // 'open_stock',
            // 'current_stock',
            $table->id();
            $table->unsignedBigInteger('close_shift_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pump_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('nozzle_id');
            $table->unsignedDecimal('open_stock', 16, 4);
            $table->unsignedDecimal('current_stock', 16, 4);
            $table->unsignedDecimal('product_price', 16, 4);
            $table->unsignedDecimal('balance', 16, 4);
            $table->unsignedDecimal('amount', 16, 4);
            $table->enum('category', ['petrol', 'diesel','kerosine']);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('close_shift_items');
    }
}
