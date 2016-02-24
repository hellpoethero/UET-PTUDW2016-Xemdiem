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
            $table->integer('mon_hoc_id')->unsigned();
            $table->integer('hoc_ky_nam_hoc_id')->unsigned();
            $table->integer('so_thu_tu');
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
        Schema::drop('lop_mon_hoc');
    }
}
