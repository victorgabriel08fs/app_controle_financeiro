<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo');
            $table->unsignedBigInteger('conta_id');
            $table->unsignedBigInteger('conta_id_2');
            $table->decimal('valor', 18, 2);
            $table->timestamps();

            $table->foreign('conta_id')->references('id')->on('contas');
            $table->foreign('conta_id_2')->references('id')->on('contas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentacoes');
    }
}
