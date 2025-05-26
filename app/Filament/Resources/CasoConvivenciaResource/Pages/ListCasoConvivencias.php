<?php

namespace App\Filament\Resources\CasoConvivenciaResource\Pages;

use App\Filament\Resources\CasoConvivenciaResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListCasoConvivencias extends ListRecords
{
    protected static string $resource = CasoConvivenciaResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
