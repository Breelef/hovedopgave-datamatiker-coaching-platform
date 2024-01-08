<?php

namespace App\Filament\Resources\SessionGroupResource\Pages;

use App\Filament\Resources\SessionGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSessionGroups extends ListRecords
{
    protected static string $resource = SessionGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
