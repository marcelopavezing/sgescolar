<?php

namespace App\Filament\Resources\CasoConvivenciaResource\Pages;

use App\Filament\Resources\CasoConvivenciaResource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CasoConvivenciaResource\Pages\PrintRegistroLlamados;
use Filament\Actions;

class EditCasoConvivencia extends EditRecord
{
    protected static string $resource = CasoConvivenciaResource::class;

    protected function getHeaderActions(): array
    {
        return array_merge(
            parent::getHeaderActions(),
            [
                Actions\Action::make('imprimir_registro_llamados')
                    ->label('Imprimir Registro de Llamados')
                    ->icon('heroicon-o-printer')
                    ->url(fn() => PrintRegistroLlamados::getUrl(['record' => $this->record->id]), true)
                    ->openUrlInNewTab(),
            ]
        );
    }
}
