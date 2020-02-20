<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateNotas2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nota');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('categoria_id');
             
            $table->foreign('cliente_id')
                    ->references('id')
                    ->on('clientes')
                    ->onDelete('cascade');;

            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categorias')
                    ->onDelete('cascade');;

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
        Schema::dropIfExists('notas');
    }
}
