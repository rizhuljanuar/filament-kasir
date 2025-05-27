<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Imports\ProductImport;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('importProducts')
                ->label('Import Product')
                ->icon('heroicon-s-arrow-down-tray')
                ->color('danger')
                ->form([
                    FileUpload::make('attachment')
                        ->label('Upload Template Produk')
                ])
                ->action(function (array $data) {
                    $file = public_path('storage/'. $data['attachment']);

                    try {
                        Excel::import(new ProductImport, $file);
                        Notification::make()
                            ->title('Product Imported')
                            ->success()
                            ->send();
                    } catch(\Exception $e) {
                        Notification::make()
                            ->title('Product failed to import')
                            ->danger()
                            ->send();
                    }
                })
        ];
    }
}
