<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListasItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas_itens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lista');
            $table->string('produto');
            $table->bigInteger('quantidade');
            $table->string('unidade')->nullable();
            $table->string('status');
            $table->text('observacao')->nullable();
            $table->double('valor', 8,2)->nullable();
            $table->timestamps();

            $table->foreign('lista')->references('id')->on('listas')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listas_itens');
    }
}
