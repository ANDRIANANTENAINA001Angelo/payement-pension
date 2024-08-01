<?php

namespace App\Http\Controllers;

use App\Models\Pensionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function TestMaping(Request $request){
        $pensionnaires = DB::table("pensionnaires")->select(["numCnaps","cin","numMatricule","solde"])->get();
        foreach ($pensionnaires as $pensionnaire) {
            if($pensionnaire->solde==0){
                $pensionnaire->solde="0";
            }
        }
        
        return $pensionnaires;



    }
}
