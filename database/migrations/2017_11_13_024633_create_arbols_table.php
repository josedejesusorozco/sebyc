<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArbolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arboles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genero', 50)->nullable();
            $table->string('epiteto', 50)->nullable();
            $table->string('categoria_infra', 20)->nullable();
            $table->string('infraespecie', 50)->nullable();
            $table->integer('numero_arbol')->nullable();
            $table->integer('numero_tallo')->nullable();
            $table->integer('tallos')->nullable();
            $table->float('diametro')->nullable();
            $table->float('altura')->nullable();
            $table->string('condicion', 10);
            $table->float('latitud')->nullable();
            $table->float('longitud')->nullable();
            $table->string('clave_ecoregion_n2', 20)->nullable();
            $table->string('tabla', 50)->nullable();
            $table->integer('id_tabla')->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arboles');
    }
}
