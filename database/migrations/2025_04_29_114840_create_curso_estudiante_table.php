<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoEstudianteTable extends Migration
{
    public function up(): void
    {
        Schema::create('curso_estudiante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_estudiante');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('id_estudiante')->references('id')->on('estudiantes')->onDelete('cascade');

            // Ensure a student can only be in a course once
            $table->unique(['id_curso', 'id_estudiante']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_estudiante');
    }
};
