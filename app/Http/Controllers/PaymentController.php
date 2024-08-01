<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Historique;
use App\Models\Pensionnaire;
use Filament\Notifications\Notification;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Simulation de traitement de paiement
        $pensionnaireId = $request->input('pensionnaire_id');
        $pensionnaire = Pensionnaire::find($pensionnaireId);
        $pensionnaire->solde -= $request->input('montant');
        $pensionnaire->save();

        // Ajouter une entrée dans l'historique
        Historique::create([
            'date_payment' => now(),
            'pensionnaire_id' => $pensionnaireId,
            'montant' => $request->input('montant'),
            'personnel_id' => auth()->id(), // Assurez-vous que l'utilisateur est authentifié
        ]);

        Notification::make()
            ->title('Paiement effectué avec succès.')
            ->success()
            ->send();

        // Rediriger avec un message de succès
        return redirect()->route('filament.resources.pensionnaires.index');
    }
}
