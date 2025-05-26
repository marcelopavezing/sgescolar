<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Periodo;
use App\Models\TipoCurso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get periodo 2025
        $periodo2025 = Periodo::where('nombre', '2025')->first();
        
        // Get tipo curso "Enseñanza Básica"
        $tipoBasica = TipoCurso::where('nombre', 'Enseñanza Básica')->first();
        $tipoMedia = TipoCurso::where('nombre', 'Enseñanza Media')->first();
        
        // Ensure we have the required data
        if (!$periodo2025 || !$tipoBasica || !$tipoMedia) {
            echo "Error: Required data not found. Please run migrations first.\n";
            return;
        }
        
        // Create basic education courses
        $cursosBasica = [
            'Primero A', 'Primero B', 
            'Segundo A', 'Segundo B',
            'Tercero A', 'Tercero B',
            'Cuarto A', 'Cuarto B',
            'Quinto A', 'Quinto B',
            'Sexto A', 'Sexto B',
            'Séptimo A', 'Séptimo B',
            'Octavo A', 'Octavo B'
        ];
        
        foreach ($cursosBasica as $curso) {
            DB::table('cursos')->insert([
                'nombre' => $curso,
                'id_tipo' => $tipoBasica->id,
                'activo' => true,
                'id_periodo' => $periodo2025->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        // Create high school courses
        $cursosMedia = [
            'Primero Medio A', 'Primero Medio B',
            'Segundo Medio A', 'Segundo Medio B',
            'Tercero Medio A', 'Tercero Medio B',
            'Cuarto Medio A', 'Cuarto Medio B'
        ];
        
        foreach ($cursosMedia as $curso) {
            DB::table('cursos')->insert([
                'nombre' => $curso,
                'id_tipo' => $tipoMedia->id,
                'activo' => true,
                'id_periodo' => $periodo2025->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
