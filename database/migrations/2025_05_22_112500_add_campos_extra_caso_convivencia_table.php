<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('caso_convivencia', function (Blueprint $table) {
            $table->date('fecha_medida_o_suspension')->nullable()->after('id');
            $table->string('lugar', 255)->nullable()->after('fecha_medida_o_suspension');
            $table->unsignedBigInteger('id_tipo_conflicto')->nullable()->after('lugar');
            $table->text('acciones_o_estrategias')->nullable()->after('id_tipo_conflicto');
            $table->date('fecha_monitoreo')->nullable()->after('acciones_o_estrategias');
            $table->text('observacion_monitoreo')->nullable()->after('fecha_monitoreo');
            $table->json('registro_de_llamados')->nullable()->after('observacion_monitoreo');

            $table->foreign('id_tipo_conflicto')
                ->references('id')
                ->on('tipo_conflicto')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('caso_convivencia', function (Blueprint $table) {
            $table->dropForeign(['id_tipo_conflicto']);
            $table->dropColumn([
                'fecha_medida_o_suspension',
                'lugar',
                'id_tipo_conflicto',
                'acciones_o_estrategias',
                'fecha_monitoreo',
                'observacion_monitoreo',
                'registro_de_llamados',
            ]);
        });
    }
};
