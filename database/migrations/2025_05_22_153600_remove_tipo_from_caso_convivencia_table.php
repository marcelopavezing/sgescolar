<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('caso_convivencia', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }

    public function down(): void
    {
        Schema::table('caso_convivencia', function (Blueprint $table) {
            $table->enum('tipo', ['conflicto', 'acoso', 'maltrato', 'otro'])->nullable();
        });
    }
};
