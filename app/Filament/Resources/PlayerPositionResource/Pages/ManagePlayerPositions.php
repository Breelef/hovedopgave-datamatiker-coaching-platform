<?php

namespace App\Filament\Resources\PlayerPositionResource\Pages;

use App\Filament\Resources\PlayerPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePlayerPositions extends ManageRecords
{
    protected static string $resource = PlayerPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
