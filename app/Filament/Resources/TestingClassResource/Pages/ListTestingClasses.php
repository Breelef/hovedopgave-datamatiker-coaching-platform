<?php

namespace App\Filament\Resources\TestingClassResource\Pages;

use App\Filament\Resources\TestingClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestingClasses extends ListRecords
{
    protected static string $resource = TestingClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
