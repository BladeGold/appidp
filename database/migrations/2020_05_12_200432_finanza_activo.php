<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FinanzaActivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('finanza_activo', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('iglesia_id');
            $table->foreign('iglesia_id')
                ->references('id')
                ->on('iglesias')
                ->onDelete('cascade');
            $table->unsignedInteger('monto');
            $table->dateTime('fecha');
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
        //
    }
}
