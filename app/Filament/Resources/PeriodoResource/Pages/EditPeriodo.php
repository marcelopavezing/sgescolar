<?php

namespace App\Filament\Resources\PeriodoResource\Pages;

use App\Filament\Resources\PeriodoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeriodo extends EditRecord
{
    protected static string $resource = PeriodoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
