<?php
// app/Exports/PensionnairesExport.php

namespace App\Exports;

use App\Models\Pensionnaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PensionnairesExport implements FromCollection
{
    /**
     * Retourne une collection des pensionnaires.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection([
            ["Nom","NumeroCnaps","NumeroMatricule","CIN","Solde"],
            Pensionnaire::select('name','numCnaps', 'numMatricule','cin', 'solde')->get()
        ]);
        // Pensionnaire::all()
        // $this->loadAndMap()->toArray()
    }

    // public function loadAndMap(){
    //     $pensionnaires = DB::table("pensionnaires")->select(["numCnaps","cin","numMatricule","solde"])->get();
    //     foreach ($pensionnaires as $pensionnaire) {
    //         if($pensionnaire->solde==0){
    //             $pensionnaire->solde="0";
    //         }
    //     }
        
    //     return $pensionnaires;
    // }
}

?>