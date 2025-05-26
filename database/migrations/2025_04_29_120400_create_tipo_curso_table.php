<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTipoCursoTable extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_curso', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        // Insert initial course types
        DB::table('tipo_curso')->insert([
            ['nombre' => 'Enseñanza Básica', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Enseñanza Media', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_curso');
    }
};
