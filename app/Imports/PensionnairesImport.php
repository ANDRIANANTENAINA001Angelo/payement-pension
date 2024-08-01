<?php 
namespace App\Imports;

use App\Models\Pensionnaire;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PensionnairesImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
     * Transforme chaque ligne du fichier en un modèle Pensionnaire.
     *
     * @param array $row
     * @return \App\Models\Pensionnaire|null
     */
    public function model(array $row)
    {
        // dd($row);
        // return new Pensionnaire([
        //     'numCnaps' => $row[0],
        //     'numMatricule' => $row[1],
        //     'cin' => $row[2],
        //     'solde' => $row[3]
        // ]);

        return new Pensionnaire([
            'name'=>$row["nom"],
            'numCnaps' => $row['numerocnaps'],
            'cin' => $row['cin'],
            'numMatricule' => $row['numeromatricule'],
            'solde' => $row['solde'],
        ]);
    }
}


?>