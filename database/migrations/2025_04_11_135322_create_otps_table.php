<?php

use App\Enums\OtpStatus;
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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('tries_count')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('unique_key')->nullable();
            $table->tinyInteger("status")->default(OtpStatus::Pending->value);
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
        Schema::dropIfExists('otps');
    }
};
