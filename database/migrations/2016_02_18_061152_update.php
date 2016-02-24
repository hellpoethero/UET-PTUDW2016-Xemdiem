<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('hoc_ky_nam_hoc', function (Blueprint $table) {
//            $table->foreign('nam_hoc_id')->references('id')->on('nam_hoc');
//            $table->foreign('hoc_ky_id')->references('id')->on('hoc_ky');
//        });
//        Schema::table('sinh_vien_diem', function (Blueprint $table) {
//            $table->foreign('sinh_vien_id')->references('id')->on('sinh_vien');
//            $table->foreign('lop_mon_hoc_id')->references('id')->on('lop_mon_hoc');
//        });
//        Schema::table('lop_mon_hoc', function (Blueprint $table) {
//            $table->foreign('mon_hoc_id')->references('id')->on('mon_hoc');
//            $table->foreign('hoc_ky_nam_hoc_id')->references('id')->on('hoc_ky_nam_hoc_id');
//        });
//        Schema::table('mon_hoc', function (Blueprint $table) {
//            $table->string('id_name')->after('id');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
