<?php

namespace App\Filament\Resources\OptionResource\Pages;

use App\Filament\Resources\OptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptions extends ListRecords
{
    protected static string $resource = OptionResource::class;

    protected function getTitle(): string
    {
        return "Pengaturan";
    }

    protected function getActions(): array
    {
        return [

        ];
    }
}
