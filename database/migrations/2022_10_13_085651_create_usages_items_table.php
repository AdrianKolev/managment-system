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
        Schema::create('usages_items', function (Blueprint $table) {
           
            $table->id();
            $table->unsignedBigInteger('usage_id');
            $table->string('item_title');   
            $table->unsignedInteger('quantity');
            $table->timestamps();

            $table->foreign('usage_id')->references('id')->on('usages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usages_items');
    }
};
