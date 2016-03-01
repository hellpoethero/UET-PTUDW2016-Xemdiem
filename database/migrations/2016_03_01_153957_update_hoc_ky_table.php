<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHocKyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hoc_ky_nam_hoc', function (Blueprint $table) {
            $table->string('bo_sung')->nullable()->after('nam_hoc_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hoc_ky_nam_hoc', function (Blueprint $table) {
            $table->dropColumn("bo_sung");
        });
    }
}
