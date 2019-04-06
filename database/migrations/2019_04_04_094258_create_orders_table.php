<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->bigInteger('customer_id')->unsigned();
            $table->double('price');
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->string('street')->nullable();
            $table->integer('house')->nullable();
            $table->tinyInteger('building')->nullable();
            $table->integer('apartment')->nullable();
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
}
