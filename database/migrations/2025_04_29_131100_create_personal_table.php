<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    public function up(): void
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('rut')->unique();
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->enum('rol', ['docente', 'administrativo', 'psicologa']);
            $table->string('titulo');
            $table->date('fecha_egreso');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
}
