<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasoEstudianteTable extends Migration
{
    public function up(): void
    {
        Schema::create('caso_estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caso_id')->constrained('caso_convivencia')->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caso_estudiante');
    }
}
