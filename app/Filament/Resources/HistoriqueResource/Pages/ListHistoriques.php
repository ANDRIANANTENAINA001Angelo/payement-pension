<?php

namespace App\Filament\Resources\HistoriqueResource\Pages;

use App\Filament\Resources\HistoriqueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoriquesExport;


class ListHistoriques extends ListRecords
{
    protected static string $resource = HistoriqueResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('export')
                ->label('Exporter')
                ->icon('heroicon-o-download')
                ->action(fn() => $this->exportHistoriques())
            // Actions\CreateAction::make(),
        ];
    }

    public function exportHistoriques()
    {
        return Excel::download(new HistoriquesExport, 'Historiques.xlsx');
    }


    

}
