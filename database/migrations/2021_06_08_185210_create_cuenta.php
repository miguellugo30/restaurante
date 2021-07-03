<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta', function (Blueprint $table) {
            $table->id();
            $table->float('total', 12,2);
            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre');
            $table->bigInteger('meseros_id')->unsigned();
            $table->bigInteger('mesas_id')->unsigned();
            $table->foreign('meseros_id')->references('id')->on('meseros')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mesas_id')->references('id')->on('mesas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta');
    }
}
