<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give_cashes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tid');
            $table->unsignedBigInteger('pump_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('cash_given_by');
            $table->decimal('amount', 16, 4);
            $table->enum('status', ['pending', 'approved','rejected'])->default('pending');
            $table->string('approve_note')->nullable();
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
        Schema::dropIfExists('give_cashes');
    }
}
