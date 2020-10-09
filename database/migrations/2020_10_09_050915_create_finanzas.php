<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanzas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finanzas', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('iglesia_id');
            //$table->foreign('iglesia_id')
              //  ->references('id')
                //->on('iglesias')
                //->onDelete('cascade');
            $table->unsignedInteger('monto');
            $table->dateTime('fecha');
            $table->enum('tipo', ['Pasivo', 'Activo']);
            $table->timestamps();
        });

        schema::create('finanza_iglesia', function (Blueprint $table){
            $table->unsignedBigInteger('finanza_id');
            $table->foreign('finanza_id')
                    ->references('id')
                    ->on('finanzas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('iglesia_id');
            $table->foreign('iglesia_id')
                ->references('id')
                ->on('iglesias')
                ->onDelete('cascade');
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
        Schema::dropIfExists('finanzas');
    }
}
