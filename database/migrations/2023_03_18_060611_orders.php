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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            // $table->foreignId('user_id')->index()->constrained()->onDelete("CASCADE")->onUpdate("CASCADE");
            // $table->foreignId('business_id')->index()->constrained()->onDelete("CASCADE")->onUpdate("CASCADE");
            // $table->foreignId('crm_id')->index()->constrained()->onDelete("CASCADE")->onUpdate("CASCADE");
            $table->integer('total_price');
            $table->string('status');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::drop('orders');
    }
};
