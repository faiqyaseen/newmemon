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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name', 30)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('phone_number2', 15)->nullable();
            $table->string('phone_number3', 15)->nullable();
            $table->unsignedBigInteger('cnic')->default(0);
            $table->string('cnic_pic', 100)->nullable();
            $table->string('location_pic', 100)->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('location')->nullable();
            $table->string('location2')->nullable();
            $table->text('agreement')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedInteger('customer_type_id')->default(1);
            $table->string('reference')->nullable();
            $table->string('dealer')->nullable();
            $table->unsignedBigInteger('dealer_cnic')->nullable();
            $table->string('proprietor')->nullable();
            $table->unsignedBigInteger('proprietor_cnic')->nullable();
            $table->unsignedInteger('status')->default(1);
            $table->boolean('is_owner')->default(1);
            $table->unsignedInteger('discount_id')->default(1);
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
        Schema::dropIfExists('customers');
    }
};
