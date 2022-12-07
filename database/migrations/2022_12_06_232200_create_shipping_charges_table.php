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
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->float('zero_fiveHundred')->nullable();
            $table->float('fiveHundredOne_oneThousand')->nullable();
            $table->float('oneThousandOne_twoThousand')->nullable();
            $table->float('twoThousandOne_fiveThousand')->nullable();
            $table->float('above_FiveThousand')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('shipping_charges');
    }
};
