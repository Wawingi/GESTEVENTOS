<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoAssento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('designacao')->unique();
            $table->string('tipo');
            $table->integer('capacidade');
            $table->unsignedInteger('id_evento');
            $table->foreign('id_evento')->references('id')->on('evento');

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
        Schema::dropIfExists('evento_assento');
    }
}
