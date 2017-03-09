<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('artistas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('artista_id');
            $table->String('nombre');
            $table->String('a_paterno');
            $table->String('a_materno');
            $table->timestamps();
            $table->foreign('artista_id')->references('obra_id')->on('obras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('artistas');
    }

}
