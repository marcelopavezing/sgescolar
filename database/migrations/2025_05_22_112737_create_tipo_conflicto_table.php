<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTipoConflictoTable extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_conflicto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',120)->unique();
            $table->timestamps();
        });

        // Insert initial periods
        DB::table('tipo_conflicto')->insert([
            ['nombre' => 'Conflictos entre estudiantes por relaciones interpersonales', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Acoso escolar o bullying', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Discriminación y exclusión', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Conflictos entre estudiantes y docentes', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Violencia verbal o física', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Conflictos por uso de redes sociales o tecnologías', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Problemas por incumplimiento de normas de convivencia', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tensiones por diferencias culturales o contextuales', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_conflicto');
    }
};
