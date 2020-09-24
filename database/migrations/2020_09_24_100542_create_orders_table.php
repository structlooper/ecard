<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('order_id');
            $table->string('invoice_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('tbl_users')->references('user_id')
                ->on('tbl_users')->onDelete('cascade');
            $table->integer('user_address_id');
            $table->integer('card_id');
            $table->enum('order_type',['Schedule','Picked','Completed','Cancel']);
            $table->double('price')->default(0);
            $table->double('delivery_charges')->default(0);
            $table->double('gst_charges')->default(0);
            $table->double('item_subtotal')->default(0);
            $table->double('total_price')->default(0);
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
