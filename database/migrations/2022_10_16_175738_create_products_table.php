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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('admin_type');
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->string('product_color');
            $table->string('product_code');
            $table->float('product_price');
            $table->float('product_discount')->default(0);
            $table->float('product_weight')->default(0);
            $table->string('product_image');
            $table->string('description');
            $table->string('meta_title');
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->enum('featured',['is_featured', 'is_latest', 'is_trending', 'is_best_rated', 'is_most_viewed','is_best_seller'])->nullable();
            $table->enum('status',[1, 0])->default(1);
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
        Schema::dropIfExists('products');
    }
};
