<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodoEstudianteTable extends Migration
{
    public function up(): void
    {
        Schema::create('periodo_estudiante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periodo');
            $table->unsignedBigInteger('id_estudiante');
            $table->text('observaciones')->nullable();
            $table->boolean('promovido')->default(false);
            $table->timestamps();

            $table->foreign('id_periodo')->references('id')->on('periodos')->onDelete('restrict');
            $table->foreign('id_estudiante')->references('id')->on('estudiantes')->onDelete('cascade');

            // Unique constraint to prevent duplicate period-student associations
            $table->unique(['id_periodo', 'id_estudiante']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodo_estudiante');
    }
};
