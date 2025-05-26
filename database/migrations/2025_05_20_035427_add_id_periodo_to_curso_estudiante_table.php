<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('curso_estudiante', function (Blueprint $table) {
            $table->unsignedBigInteger('id_periodo');
$table->foreign('id_periodo')->references('id')->on('periodos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curso_estudiante', function (Blueprint $table) {
            $table->unsignedBigInteger('id_periodo');
$table->foreign('id_periodo')->references('id')->on('periodos')->onDelete('cascade');
        });
    }
};
