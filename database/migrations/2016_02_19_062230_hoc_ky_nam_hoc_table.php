<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HocKyNamHocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoc_ky_nam_hoc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('nam_hoc_id')->unsigned();
            $table->timestamps();

            $table->foreign('nam_hoc_id')->references('id')->on('nam_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hoc_ky_nam_hoc');
    }
}
