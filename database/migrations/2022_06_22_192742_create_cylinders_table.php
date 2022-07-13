<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cylinders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('type');
            $table->unsignedInteger('assign_to')->default(0)->comment('Customer id only if order has confirmed');
            $table->unsignedInteger('branch_id')->default(1);
            $table->integer('is_filled')->default(0)->comment('1 if filled, 0 if not filled');
            $table->date('date_purchased');
            $table->float('buy_price')->nullable();
            $table->unsignedInteger('condition')->default(1);
            $table->unsignedInteger('wall_type')->default(1);
            $table->string('serial_number')->nullable();
            $table->string('scan_number')->nullable();
            $table->unsignedInteger('status')->default(1);
            $table->unsignedBigInteger('sell_to')->default(0);
            $table->float('sell_price')->nullable();
            $table->date('date_sell')->nullable();
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
        Schema::dropIfExists('cylinders');
    }
};
