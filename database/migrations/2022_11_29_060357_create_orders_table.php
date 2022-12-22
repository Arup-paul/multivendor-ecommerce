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
            $table->string('order_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('delivery_address_id')->constrained('delivery_addresses')->onDelete('cascade');
            $table->float('shipping_charge')->default(0);
            $table->string('coupon_code')->nullable();
            $table->float('coupon_discount')->default(0);
            $table->integer('order_status'); // 0 = pending, 1 = processing, 2 = shipping, 3 = completed, 4 = canceled 5 = delivered
            $table->string('payment_method');
            $table->integer('payment_status'); // 0 = failed, 1 = complete, 2 = pending, 3 = incomplete
            $table->string('payment_gateway');
            $table->float('grand_total');
            $table->string('courier_name')->nullable();
            $table->string('tracking_number')->nullable();
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
