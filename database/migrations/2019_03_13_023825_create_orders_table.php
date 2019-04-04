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
        Schema::create('orders_test', function (Blueprint $table) {
            $table->integer('orders_id');
            $table->integer('customers_id')->unsigned()->nullable(false);
            $table->string('delivery_name')->nullable(false);
            $table->timestamp('date_purchased')->nullable(false);
            $table->timestamps();
            $table->primary('orders_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_test');
    }
}
