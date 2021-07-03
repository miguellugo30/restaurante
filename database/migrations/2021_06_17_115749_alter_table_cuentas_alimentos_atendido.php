<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCuentasAlimentosAtendido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuentas_alimentos', function (Blueprint $table) {
            $table->integer('atendido')->unsigned()->default(0)->after('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuentas_alimentos', function (Blueprint $table) {
            $table->dropColumn(['atendido']);
        });
    }
}
