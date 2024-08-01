<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use App\Imports\PensionnairesImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportPensionnaires extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-upload';
    protected static string $view = 'filament.pages.import-pensionnaires';

    public function import(Request $request)
    {
        $validatedData = $this->form->getState();

        $file = $validatedData['file'];

        Excel::import(new PensionnairesImport, $file);

        Notification::make()
            ->title('Importation effectuée avec succès.')
            ->success()
            ->send();

        return redirect()->route('filament.resources.pensionnaires.index');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('file')
                ->required()
                ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']),
        ];
    }
}