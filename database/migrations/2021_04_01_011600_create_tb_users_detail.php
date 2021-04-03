<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsersDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_users_detail', function (Blueprint $table) {
            $table->id('id_user_detail');
            $table->string('alamat',60);
            $table->integer('nomor_hp');
            $table->integer('kode_pos');
            $table->char('jenis_klamin',1);
            $table->integer('users_id');
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
        Schema::dropIfExists('tb_users_detail');
    }
}
