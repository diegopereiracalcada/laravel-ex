<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddNumerochamadoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->bigInteger('numerochamado')->nullable()->unique();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropIfExists('numerochamado');            
        });
    }
}
