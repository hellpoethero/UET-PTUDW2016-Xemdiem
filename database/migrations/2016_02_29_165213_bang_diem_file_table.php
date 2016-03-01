<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BangDiemFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bang_diem_file', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->integer('lop_mon_hoc_id')->unique()->unsigned();
            $table->timestamps();

            $table->foreign('lop_mon_hoc_id')->references('id')->on('lop_mon_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bang_diem_file');
    }
}
