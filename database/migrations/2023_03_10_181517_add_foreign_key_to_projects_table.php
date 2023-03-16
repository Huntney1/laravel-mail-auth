<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     ** Eseguire la igrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {

            //* Prima Creiamo la Colonna.
            $table->unsignedBigInteger('category_id')  //! <--- Questo Codice va Con...
                ->nullable()->after('id');

            //* Dopo Creo la Foreign Key.
            $table->foreign('category_id')  //! <--- ...Questo Codice
                ->references('id')          //* Nome Della Colonna a Cui fa Riferimento...
                ->on('categories')          //*...E di Quale Tabella Appartiene
                ->onDelete('set null');     //* Setta Esplicitamente a NULL la Colonna Nel Caso venga cancellata la Categoria

        });
    }

    /**
     * Reverse the migrations.
     ** Invertire la migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //* 1° PASSAGGIO
            $table->dropForeign('projects_category_id_foreign'); //* Droppa Nella Tabella Projects la Colonna Category_id che è la FORIGN

            //* 2° PASSAGGIO
            $table->dropColumn('category_id'); //* Droppo la Colonna

        });
    }
};
