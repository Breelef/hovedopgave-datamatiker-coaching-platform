<?php

namespace App\Filament\Resources\TestingClassResource\Pages;

use App\Filament\Resources\TestingClassResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestingClass extends CreateRecord
{
    protected static string $resource = TestingClassResource::class;
}
