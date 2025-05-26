<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoToCursosTable extends Migration
{
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tipo')->after('nombre');
            $table->foreign('id_tipo')->references('id')->on('tipo_curso')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign(['id_tipo']);
            $table->dropColumn('id_tipo');
        });
    }
};
