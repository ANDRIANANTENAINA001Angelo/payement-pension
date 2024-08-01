<!-- resources/views/filament/pages/import-pensionnaires.blade.php -->

<x-filament::page>
    <form wire:submit.prevent="import" class="space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit">
            Importer
        </x-filament::button>
    </form>
</x-filament::page>
