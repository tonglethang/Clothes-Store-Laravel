<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id('MaSP');
            $table->string('TenSP');
            $table->string('Hang');
            $table->integer('Soluong');
            $table->integer('Soluongcon');
            $table->string('Color');
            $table->integer('Gia');
            $table->string('Image');
            $table->string('Size');
            $table->string('Note');
            $table->string('Loai');
            $table->string('DanhMuc');
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
        Schema::dropIfExists('table_sanpham');
    }
}
