<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObrasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('obras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('obra_id'); 
            $table->Text('artista');
            $table->Text('UID');
            $table->String('nombre_obra')->unique();
            $table->Text('descripcion');
            $table->Text('link_imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('obras');
    }

}
