<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PensionnairesExport;
use App\Exports\HistoriquesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PensionnairesImport;
use Filament\Notifications\Notification;

class ExcelController extends Controller
{
    public function exportPensionnaires()
    {
        return Excel::download(new PensionnairesExport, 'pensionnaires.xlsx');
    }

    public function exportHistoriques()
    {
        return Excel::download(new HistoriquesExport, 'historiques.xlsx');
    }

    public function importPensionnaires(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new PensionnairesImport, $request->file('file'));

        // Notification::make()
        // ->title('Importation effectué avec succès.')
        // ->success()
        // ->send();
        return response()->json(" import done");
    // Rediriger avec un message de succès
    // return redirect()->route('filament.resources.pensionnaires.index');
    }


}
