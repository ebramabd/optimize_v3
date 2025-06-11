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
        Schema::table('terms_of_agreements', function (Blueprint $table) {
            $table->text('condition_text_ar')->after('condition_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terms_of_agreements', function (Blueprint $table) {
            $table->dropColumn(['condition_text_ar']);
        });
    }
};
