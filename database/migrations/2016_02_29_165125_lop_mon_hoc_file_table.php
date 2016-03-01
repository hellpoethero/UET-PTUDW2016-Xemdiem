<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LopMonHocFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop_mon_hoc_file', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->integer('hoc_ky_nam_hoc_id')->unsigned();
            $table->timestamps();

            $table->foreign('hoc_ky_nam_hoc_id')->references('id')->on('hoc_ky_nam_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lop_mon_hoc_file');
    }
}
