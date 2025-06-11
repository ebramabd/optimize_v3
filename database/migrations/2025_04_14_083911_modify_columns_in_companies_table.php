<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement('ALTER TABLE `companies` CHANGE `tax_number` `tax_number` BIGINT NULL DEFAULT NULL;');
        DB::statement('ALTER TABLE `companies` CHANGE `commercial_registration_number` `commercial_registration_number` BIGINT NOT NULL;');
        DB::statement('ALTER TABLE `companies` CHANGE `file_tax` `file_tax` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
