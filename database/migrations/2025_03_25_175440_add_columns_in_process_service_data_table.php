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
        Schema::table('process_service_data', function (Blueprint $table) {
            $table->integer('status')->default(\App\Enums\OrderStatus::Under_processing)->after('application_area');
            $table->integer('order_id')->unique()->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process_service_data', function (Blueprint $table) {
            $table->dropColumn(['status', 'order_id']);
        });
    }
};
