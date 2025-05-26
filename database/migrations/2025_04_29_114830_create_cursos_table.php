<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('id_periodo');
            $table->timestamps();

            $table->foreign('id_periodo')->references('id')->on('periodos')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
