<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisitante');
            $table->unsignedBigInteger('grupo')->nullable();
            $table->string('status');
            $table->double('valor', 8,2)->nullable();
            $table->timestamps();

            $table->foreign('requisitante')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('grupo')->references('id')->on('grupo')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listas');
    }
}
