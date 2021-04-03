<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAlamatOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_alamat_order', function (Blueprint $table) {
            $table->id('id_alamat');
            $table->string('name',50);
            $table->string('email',50);
            $table->string('alamat',100);
            $table->integer('nomor_hp');
            $table->integer('kode_pos');
            $table->char('jenis_klamin',1);

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
        Schema::dropIfExists('tb_alamat_order');
    }
}
