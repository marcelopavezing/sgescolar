<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class generosRegionesComunasEstudiantesTable extends Migration
{
    public function up(): void
    {
        // Tabla generos
        Schema::create('generos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        // Tabla regiones
        Schema::create('regiones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        // Tabla comunas
        Schema::create('comunas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_region');
            $table->string('nombre', 100);
            $table->timestamps();

            $table->foreign('id_region')->references('id')->on('regiones')->onDelete('cascade');
        });

        // Tabla estudiantes
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('rut', 15);
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->string('nombre_social', 100)->nullable();
            $table->unsignedBigInteger('genero');
            $table->unsignedBigInteger('region');
            $table->unsignedBigInteger('ciudad');
            $table->string('direccion', 200);
            $table->boolean('estado');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('genero')->references('id')->on('generos')->onDelete('restrict');
            $table->foreign('region')->references('id')->on('regiones')->onDelete('restrict');
            $table->foreign('ciudad')->references('id')->on('comunas')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
        Schema::dropIfExists('comunas');
        Schema::dropIfExists('regiones');
        Schema::dropIfExists('generos');
    }
};
