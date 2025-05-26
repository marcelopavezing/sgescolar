<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePeriodosTable extends Migration
{
    public function up(): void
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 10)->unique();
            $table->timestamps();
        });

        // Insert initial periods
        DB::table('periodos')->insert([
            ['nombre' => '2025', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => '2026', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('periodos');
    }
};
