<x-filament::page>
    <div class="flex items-center justify-center">
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-center mb-6">Payer le Pensionnaire</h2>

            <div class="mt-4 mb-6">
                <p class="text-center"><strong>Nom du pensionnaire :</strong> {{ $pensionnaire->name }}</p>
                <p class="text-center"><strong>Numéro CNAPS :</strong> {{ $pensionnaire->numCnaps }}</p>
                <p class="text-center"><strong>Solde :</strong> {{ $pensionnaire->solde }} Ar</p>
            </div>

            <div class="mt-10 flex justify-center space-x-4">
                <form method="POST" action={{ route('process.payment') }} class="flex justify-center space-x-4">
                    @csrf
                    <input type="hidden" name="pensionnaire_id" value="{{ $pensionnaire->id }}">
                    <input type="hidden" name="montant" value={{ $pensionnaire->solde }}> <!-- Remplacez avec le montant approprié -->
                    <button 
                        @if ( $pensionnaire->solde ==0)
                            @disabled(true)
                            style="background-color: gray; color: white; padding: 10px; border-radius: 5px;"
                        @else 
                            type="submit" style="background-color: green; color: white; padding: 10px; border-radius: 5px;"
                        @endif >
                        Valider
                    </button>
                    {{-- <button 
                        @if ($pensionnaire->solde == 0)
                            class="btn btn-disabled"
                            disabled
                        @else
                            class="btn btn-primary"
                        @endif 
                        type="submit">
                        Valider
                    </button> --}}

                </form>
                <a href="{{ route('filament.resources.pensionnaires.index') }}" style="background-color: gray; color: white; padding: 10px; border-radius: 5px;">
                    Annuler
                </a>
            </div>
        </div>
    </div>
</x-filament::page>
