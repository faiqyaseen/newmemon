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
        Schema::create('sales_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_purchase')->comment('0 => sale, 1 => purchase');
            $table->unsignedBigInteger('branch_id')->nullable()->default(0);
            $table->integer('status')->default(2)->comment('1 => confirmed, 2 => pending, 3 => cancelled, 4 => edited');
            $table->integer('company_id')->nullable()->default(0);
            $table->float('kg');
            $table->float('rate');
            $table->float('credit')->nullable();
            $table->date('sale_purchase_date');
            $table->text('remarks')->nullable();
            $table->string('driver')->nullable();
            $table->string('conductor')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('vehicle_number')->nullable();
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
        Schema::dropIfExists('sales_purchases');
    }
};
