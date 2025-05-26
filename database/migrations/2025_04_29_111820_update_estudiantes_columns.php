<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEstudiantesColumns extends Migration
{
    public function up(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['genero']);
            $table->dropForeign(['region']);
            $table->dropForeign(['ciudad']);

            // Rename columns
            $table->renameColumn('genero', 'id_genero');
            $table->renameColumn('region', 'id_region');
            $table->renameColumn('ciudad', 'id_ciudad');

            // Re-add foreign key constraints with new column names
            $table->foreign('id_genero')->references('id')->on('generos')->onDelete('restrict');
            $table->foreign('id_region')->references('id')->on('regiones')->onDelete('restrict');
            $table->foreign('id_ciudad')->references('id')->on('comunas')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            // Drop new foreign key constraints
            $table->dropForeign(['id_genero']);
            $table->dropForeign(['id_region']);
            $table->dropForeign(['id_ciudad']);

            // Revert column names
            $table->renameColumn('id_genero', 'genero');
            $table->renameColumn('id_region', 'region');
            $table->renameColumn('id_ciudad', 'ciudad');

            // Re-add original foreign key constraints
            $table->foreign('genero')->references('id')->on('generos')->onDelete('restrict');
            $table->foreign('region')->references('id')->on('regiones')->onDelete('restrict');
            $table->foreign('ciudad')->references('id')->on('comunas')->onDelete('restrict');
        });
    }
};
