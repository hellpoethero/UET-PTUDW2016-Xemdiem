<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SinhVienDiemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinh_vien_diem', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sinh_vien_id')->unsigned();
            $table->integer('lop_mon_hoc_id')->unsigned();
            $table->float('diem');
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
        Schema::drop('sinh_vien_diem');
    }
}
