<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasoConvivenciaTable extends Migration
{
    public function up(): void
    {
        Schema::create('caso_convivencia', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_medida_o_suspension')->nullable();
            $table->string('lugar', 255)->nullable();
            $table->unsignedBigInteger('id_tipo_conflicto')->nullable();
            $table->text('acciones_o_estrategias')->nullable();
            $table->date('fecha_monitoreo')->nullable();
            $table->text('observacion_monitoreo')->nullable();
            $table->json('registro_de_llamados')->nullable();
            $table->text('descripcion');
            $table->date('fecha_apertura');
            $table->date('fecha_cierre')->nullable();
            $table->enum('estado', ['abierto', 'en curso', 'resuelto'])->default('abierto');
            $table->boolean('grupal')->default(false);
            $table->enum('tipo', ['conflicto', 'acoso', 'maltrato', 'otro'])->nullable();
            $table->enum('severidad', ['baja', 'media', 'alta'])->nullable();
            $table->timestamps();

            $table->foreign('id_tipo_conflicto')
                ->references('id')
                ->on('tipo_conflicto')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caso_convivencia');
    }
}
