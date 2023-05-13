<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDondathang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dondathang', function (Blueprint $table) {
            $table->id('MaDon');
            $table->unsignedBigInteger('MaKH');
            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->string('TenSP');
            $table->integer('TongTien');     
            $table->integer('SoLuongDH');
            $table->string('Phuongthuc');
            $table->datetime('ThoiGianDH');
            $table->string('status');
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
        Schema::dropIfExists('dondathang');
    }
}
