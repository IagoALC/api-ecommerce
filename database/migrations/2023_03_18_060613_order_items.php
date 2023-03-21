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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order_id')->index()->constrained()->onDelete("CASCADE")->onUpdate("CASCADE");
            $table->foreignId('product_id')->index()->constrained()->onDelete("CASCADE")->onUpdate("CASCADE");
            $table->string('quantity');
            $table->integer('unit_price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_items');
    }
};
