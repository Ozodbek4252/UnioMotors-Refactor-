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
            $table->integer('brend_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('photos');
            $table->string('name');
            $table->string('engine')->nullable();
            $table->string('capacity_uz')->nullable();
            $table->string('capacity_ru')->nullable();
            $table->string('capacity_en')->nullable();
            $table->string('reserve')->nullable();
            $table->string('unit_uz')->nullable();
            $table->string('unit_ru')->nullable();
            $table->string('unit_en')->nullable();
            $table->string('price_uz')->nullable();
            $table->string('price_ru')->nullable();
            $table->string('price_en')->nullable();
            $table->string('slug');
            $table->boolean('ok')->default(0);
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
