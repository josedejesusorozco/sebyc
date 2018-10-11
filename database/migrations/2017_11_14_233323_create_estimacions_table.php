<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_arboles')->unsigned();
            $table->float('d130')->nullable();
            $table->float('ht')->nullable();
            $table->integer('id_densidades')->unsigned()->nullable();
            $table->integer('densidad_nivel')->unsigned()->nullable();
            $table->float('densidad')->nullable();
            $table->string('ecuacion', 300)->nullable();
            $table->integer('id_modelos')->unsigned()->nullable();
            $table->integer('biomasa_nivel')->unsigned()->nullable();
            $table->float('biomasa')->nullable();
            $table->integer('id_fracciones')->unsigned()->nullable();
            $table->integer('fraccion_nivel')->unsigned()->nullable();
            $table->float('fraccion')->nullable();
            $table->float('carbono')->nullable();

            /*$table->float('DB')->nullable();
            $table->integer('DB_id_modelo')->unsigned()->nullable();
            $table->integer('DB_nivel_calidad')->unsigned()->nullable();
            $table->float('AB130')->nullable();
            $table->integer('AB130_id_modelo')->unsigned()->nullable();
            $table->integer('AB130_nivel_calidad')->unsigned()->nullable();
            $table->float('V')->nullable();
            $table->integer('V_id_modelo')->unsigned()->nullable();
            $table->integer('V_nivel_calidad')->unsigned()->nullable();
            $table->float('P')->nullable();
            $table->integer('P_id_modelo')->unsigned()->nullable();
            $table->integer('P_nivel_calidad')->unsigned()->nullable();
            $table->float('B')->nullable();
            $table->integer('B_id_modelo')->unsigned()->nullable();
            $table->integer('B_nivel_calidad')->unsigned()->nullable();
            $table->float('C')->nullable();
            $table->integer('C_id_modelo')->unsigned()->nullable();
            $table->integer('C_nivel_calidad')->unsigned()->nullable();*/
            $table->timestamps();
            $table->index('id_arboles', 'idx_id_arboles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimaciones');
    }
}
