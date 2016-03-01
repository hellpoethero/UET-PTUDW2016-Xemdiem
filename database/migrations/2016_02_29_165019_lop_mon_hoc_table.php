<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LopMonHocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop_mon_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('id_name');
            $table->integer('hoc_ky_nam_hoc_id')->unsigned();
            $table->integer('so_thu_tu');
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
        Schema::drop('lop_mon_hoc');
    }
}
