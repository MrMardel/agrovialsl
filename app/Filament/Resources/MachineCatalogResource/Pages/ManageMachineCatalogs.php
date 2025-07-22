<?php

namespace App\Filament\Resources\MachineCatalogResource\Pages;

use App\Filament\Resources\MachineCatalogResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageMachineCatalogs extends ManageRecords
{
    protected static string $resource = MachineCatalogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->closeModalByClickingAway(false)
                ->modalWidth(MaxWidth::FourExtraLarge),
        ];
    }
}
