<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id('MaCMT');
            $table->string('content');
            $table->unsignedBigInteger('MaSP');
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
            $table->unsignedBigInteger('MaKH');
            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
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
        Schema::dropIfExists('comment');
    }
}
