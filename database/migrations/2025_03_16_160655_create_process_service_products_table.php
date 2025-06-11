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
        Schema::create('process_service_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('process_id');
            $table->bigInteger('service_id');
            $table->bigInteger('brand_id');
            $table->json('items_id');
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
        Schema::dropIfExists('process_service_products');
    }
};
