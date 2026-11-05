<?php

namespace App\Filament\Resources\TeachingSessions\Pages;

use App\Filament\Resources\TeachingSessions\TeachingSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTeachingSession extends EditRecord
{
    protected static string $resource = TeachingSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
