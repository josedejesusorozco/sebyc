<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fracciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genero', 50)->nullable();
            $table->string('epiteto', 50)->nullable();
            $table->string('clave_ecoregion_n2', 20)->nullable();
            $table->float('valor');
            $table->float('diametro_min')->nullable();
            $table->float('diametro_max')->nullable();
            $table->integer('numero_arboles')->nullable();
            $table->float('r2')->nullable();
            $table->integer('id_modelo')->nullable();
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fracciones');
    }
}
