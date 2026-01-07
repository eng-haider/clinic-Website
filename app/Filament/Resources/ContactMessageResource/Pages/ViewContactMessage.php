<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('mark_as_read')
                ->label('Mark as Read')
                ->icon('heroicon-o-envelope-open')
                ->color('success')
                ->hidden(fn (): bool => $this->record->is_read)
                ->action(function () {
                    $this->record->update(['is_read' => true]);
                    $this->refreshFormData(['is_read']);
                })
                ->successNotificationTitle('Message marked as read'),
        ];
    }
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Mark as read when viewing
        if (!$this->record->is_read) {
            $this->record->update(['is_read' => true]);
        }
        
        return $data;
    }
}
