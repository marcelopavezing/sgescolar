<?php

namespace App\Filament\Resources\CasoConvivenciaResource\Pages;

use App\Filament\Resources\CasoConvivenciaResource;
use App\Models\CasoConvivencia;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\View\View;

class PrintRegistroLlamados extends Page
{
    protected static string $resource = CasoConvivenciaResource::class;
    public CasoConvivencia $record;

    public array $data = [];

    public function mount($record): void
    {
        
        // Si $record es un array, extraer el id
        if (isset($record['id'])) {
            $recordId = $record['id'];
        } else {
            $recordId = "";
        }
       // dd($recordId);
       // $string = implode(', ', $record);
        $this->record = CasoConvivencia::findOrFail($recordId);
       // dd($this->record );
       // $this->data['registro_de_llamados'] = $this->record->registro_de_llamados;
       // $this->data['caso'] = $this->record ;
    }

    public function getTitle(): string
    {
        return 'Imprimir Registro de Llamados';
    }

    public function getView(): string
    {
        return 'filament.resources.caso-convivencia.print-registro-llamados';
    }
    public function getViewData(): array
    {
        return [
            'caso' => $this->record,
            'registro_de_llamados' => $this->record->registro_de_llamados,
        ];
    }
}
