<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiaohang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaohang', function (Blueprint $table) {
            $table->id('MaGH');
            $table->string('TenGH');
            $table->string('DiaChi');
            $table->string('SDT');
            $table->string('TenDN');
            $table->string('Pass');
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
        Schema::dropIfExists('giaohang');
    }
}
