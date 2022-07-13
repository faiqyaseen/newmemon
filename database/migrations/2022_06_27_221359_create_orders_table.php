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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->float('discount')->nullable();
            $table->integer('order_type')->default(1)->nullable()->comment('1 = cylinder orders, 2 = product orders');
            $table->float('total_amount')->nullable();
            $table->float('amount_after_discount')->nullable();
            $table->float('cash_amount')->nullable();
            $table->integer('status')->default(2);
            $table->string('remarks')->nullable();
            $table->string('driver')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('conductor')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
