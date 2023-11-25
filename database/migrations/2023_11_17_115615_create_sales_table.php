<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['cash', 'invoice'])->default('invoice');
            $table->unsignedBigInteger('product_id');
            $table->unsignedDecimal('rate', 16, 4);
            $table->unsignedDecimal('qty', 16, 4);
            $table->unsignedDecimal('total_price', 16, 4);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pump_id');
            $table->unsignedBigInteger('shift_id');
            $table->string('lpo_no')->nullable();
            $table->string('vrn_no')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('driver')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->unsignedBigInteger('tid');
            $table->unsignedBigInteger('mileage');
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
        Schema::dropIfExists('sales');
    }
}
