<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('local', 150);
            $table->date('data');
            $table->time('hora');
            $table->json('numero_de_poltronas');
            $table->string('display', 255);
            $table->integer('poltronas_reservadas')->nullable();
            $table->integer('atracao_id')->unsigned();
            $table->foreign('atracao_id')->references('id')->on('atracoes');
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
        Schema::dropIfExists('sessoes');
    }
}
