<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //* TABELLA PONTE

        Schema::create('project_technology', function (Blueprint $table) {
            $table->id();

            //* Creo la Colonna Per il Progetto.
            $table->unsignedBigInteger('project_id');
           //* Aggiungo la foreign key.
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();

            //* Creo la Colonna Per le Tecnologie.
            $table->unsignedBigInteger('technology_id');
            //* Aggiungo la foreign key.
            $table->foreign('technology_id')->references('id')->on('technologies')->cascadeOnDelete();

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
        Schema::dropIfExists('project_technology');
    }
};
