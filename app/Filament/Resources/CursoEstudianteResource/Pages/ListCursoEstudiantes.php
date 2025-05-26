<?php

namespace App\Filament\Resources\CursoEstudianteResource\Pages;

use App\Filament\Resources\CursoEstudianteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCursoEstudiantes extends ListRecords
{
    protected static string $resource = CursoEstudianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
