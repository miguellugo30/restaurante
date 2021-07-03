<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasAlimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_alimentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuentas_id')->unsigned();
            $table->bigInteger('alimentos_id')->unsigned();
            $table->foreign('cuentas_id')->references('id')->on('cuentas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('alimentos_id')->references('id')->on('alimentos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cuentas_alimentos');
    }
}
