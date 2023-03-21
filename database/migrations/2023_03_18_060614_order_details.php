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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order_id')->index()->constrained()->onDelete("CASCADE")->onUpdate("CASCADE");
            $table->foreignId('country_code')->references('code')->on('countries');
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->string('email', 45);
            $table->string('phone', 45)->nullable();
            $table->string('address1', 45);
            $table->string('address2', 45);
            $table->string('city', 45);
            $table->string('state', 45)->nullable();
            $table->string('zipcode', 45);
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
        Schema::drop('order_details');
    }
};
