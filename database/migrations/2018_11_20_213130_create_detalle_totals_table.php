<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('negocio');
            $table->decimal('efectivo',5,2);
            $table->decimal('tarjeta',5,2);
            $table->decimal('sub_total',5,2);
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
        Schema::drop('detalle_totals');
    }
}
