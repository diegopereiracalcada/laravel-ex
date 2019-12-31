<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->string('observacao')->nullable();
            $table->boolean('preventiva')->default(false);
            $table->timestamp('dt_abertura');
            $table->timestamp('dt_fechamento')->nullable();
            $table->string('solucao')->nullable();
            $table->string('status')->default('ABERTO');
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();
            
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chamados');
    }
}