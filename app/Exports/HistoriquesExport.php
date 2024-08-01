<?php
// app/Exports/HistoriquesExport.php

namespace App\Exports;

use App\Models\Historique;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class HistoriquesExport implements FromCollection
{
    /**
     * Retourne une collection des historiques.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return new Collection([
        //     ["Date de Payment","ID Pensionnaire","Montant","ID Personnel"],
        //     Historique::select("date_payment","pensionnaire_id","montant","personnel_id")->get()
        //     ]);

        // Récupérer les données en joignant les relations
        $historiqueData = Historique::with(['pensionnaire', 'personnel'])
            ->get()
            ->map(function ($historique) {
                return [
                    'date_payment' => $historique->date_payment,
                    'pensionnaire' => $historique->pensionnaire ? $historique->pensionnaire->name : 'N/A',
                    'montant' => $historique->montant,
                    'personnel' => $historique->personnel ? $historique->personnel->name : 'N/A',
                ];
            });

        // Ajouter les en-têtes de colonnes
        $header = ["Date de Payment", "Nom Pensionnaire", "Montant", "Nom Personnel"];

        // Convertir en collection pour l'export
        return new Collection([$header] + $historiqueData->toArray());
    }

}

?>