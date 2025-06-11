<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Step 1: Temporarily change column type to TEXT to allow JSON conversion
        DB::statement('ALTER TABLE brand_services MODIFY COLUMN item_id TEXT');

        // Step 2: Convert existing integer values into valid JSON format
        DB::statement('UPDATE brand_services SET item_id = CONCAT("[", item_id, "]")');

        // Step 3: Convert column type to JSON
        DB::statement('ALTER TABLE brand_services MODIFY COLUMN item_id JSON');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Convert JSON back to integer (assuming single values in JSON)
        DB::statement('UPDATE brand_services SET item_id = JSON_UNQUOTE(JSON_EXTRACT(item_id, "$[0]"))');
        // Change column back to INTEGER
        DB::statement('ALTER TABLE brand_services MODIFY COLUMN item_id INT');
    }
};
