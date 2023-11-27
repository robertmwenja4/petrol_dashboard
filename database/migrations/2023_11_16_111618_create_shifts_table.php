<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->date('shift_name');
            $table->enum('status', ['open', 'closed', 'pending'])->default('pending');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('allocated_by')->nullable();
            $table->unsignedBigInteger('closed_by')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('is_readings', ['yes','no'])->default('no');
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
        Schema::dropIfExists('shifts');
    }
}
