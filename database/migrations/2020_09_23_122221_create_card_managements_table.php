<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_managements', function (Blueprint $table) {
            $table->bigIncrements('card_management_id');
            $table->unsignedBigInteger('card_category_id');
            $table->foreign('card_category_id')->references('card_id')
                ->on('card_categories')->onDelete('cascade');
            $table->string('card_management_title')->nullable();
            $table->mediumText('card_management_image')->nullable();
            $table->string('card_management_price');
            $table->enum('card_management_price_unit',['INR','USD']);
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
        Schema::dropIfExists('card_managements');
    }
}
