<?php

namespace App\Filament\Resources\SessionGroupResource\Pages;

use App\Filament\Resources\SessionGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSessionGroup extends EditRecord
{
    protected static string $resource = SessionGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
