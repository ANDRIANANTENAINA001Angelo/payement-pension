<?php

namespace App\Filament\Resources\PensionnaireResource\Pages;

use App\Filament\Resources\PensionnaireResource;
use App\Models\Pensionnaire;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Filament\Notifications\Notification;

class PayPensionnaire extends Page
{
    protected static string $resource = PensionnaireResource::class;
    protected static string $view = 'filament.pages.pay-pensionnaire';

    public Pensionnaire $pensionnaire;

    public function mount(Pensionnaire $record): void
    {
        $this->pensionnaire = $record;
    }

    public function processPayment()
    {
        // Ajoutez ici vos traitements spécifiques
        // Par exemple : mise à jour du solde, enregistrement de l'historique, etc.

        // Exemple de traitement :
        $this->pensionnaire->solde -= 100; // Déduire un montant du solde
        $this->pensionnaire->save();

        Notification::make()
            ->title('Paiement effectué avec succès.')
            ->success()
            ->send();

        return redirect()->route('filament.resources.pensionnaires.index');

    }
}



?>