<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ecuacion', 300);
            $table->float('constante_a')->nullable();
            $table->float('constante_b')->nullable();
            $table->float('constante_c')->nullable();
            $table->float('constante_d')->nullable();
            $table->float('constante_e')->nullable();
            $table->float('constante_f')->nullable();
            $table->float('constante_g')->nullable();
            $table->float('constante_h')->nullable();
            $table->float('constante_i')->nullable();
            $table->float('constante_j')->nullable();
            $table->float('constante_k')->nullable();
            $table->string('genero', 50)->nullable();
            $table->string('epiteto', 50)->nullable();
            $table->string('clave_ecoregion_n2', 20)->nullable();
            $table->float('diametro_min')->nullable();
            $table->float('diametro_max')->nullable();
            $table->integer('numero_arboles')->nullable();
            $table->float('r2')->nullable();
            $table->integer('id_modelo')->nullable();
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
        Schema::dropIfExists('modelos');
    }
}
