<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NamHocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nam_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nam_bat_dau'); //nam bat dau cua nam hoc
            $table->integer('nam_ket_thuc'); //nam ket thuc cua nam hoc
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
        Schema::drop('nam_hoc');
    }
}
