<?php

namespace App\Filament\Resources\PensionnaireResource\Pages;

use App\Exports\PensionnairesExport;
use App\Filament\Resources\PensionnaireResource;
use App\Imports\PensionnairesImport;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ListPensionnaires extends ListRecords
{
    protected static string $resource = PensionnaireResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('import')
                ->label('Importer')
                ->icon('heroicon-o-upload')
                ->action('openImportModal')
                ->modalHeading('Importer des Pensionnaires')
                ->modalWidth('lg')
                ->form([
                    FileUpload::make('file')
                        ->label('Fichier Excel')
                        ->required()
                        ->disk('local')
                        ->directory('imports')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']),
                ])
                ->action(function (array $data) {
                    $this->importPensionnaires($data);
                }),                

            Actions\Action::make('export')
                ->label('Exporter')
                ->icon('heroicon-o-download')
                ->action(fn() => $this->exportPensionnaires())
            // Actions\CreateAction::make(),
        ];
    }

    public function exportPensionnaires()
    {
        return Excel::download(new PensionnairesExport, 'Pensionnaires.xlsx');
    }

    public function importPensionnaires(array $data)
    {
        try {
            // dd($data);
            // Valider et récupérer le fichier uploadé
            /** @var TemporaryUploadedFile $file */
            $file = $data['file'];

            // Stocker le fichier dans le disque local
            $path = storage_path('app/' . $data['file']);

            // Importer les données
            Excel::import(new PensionnairesImport, $path);

            // Envoyer une notification de succès
            Notification::make()
                ->title('Importation effectuée avec succès.')
                ->success()
                ->send();

            // Supprimer le fichier après importation si nécessaire
            Storage::disk('local')->delete($path);

            // Rediriger vers la page actuelle
            return redirect()->route('filament.resources.pensionnaires.index');

        } catch (Exception $e) {
            // Log l'exception
            Log::error($e);

            // Envoyer une notification d'erreur
            Notification::make()
                ->title('Erreur lors de l\'importation')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    }
