<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasoPersonalTable extends Migration
{
    public function up(): void
    {
        Schema::create('caso_personal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caso_id')->constrained('caso_convivencia')->onDelete('cascade');
            $table->foreignId('personal_id')->constrained('personal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caso_personal');
    }
}
