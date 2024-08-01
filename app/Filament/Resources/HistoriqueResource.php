<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoriqueResource\Pages;
use App\Filament\Resources\HistoriqueResource\RelationManagers;
use App\Models\Historique;
use App\Models\Pensionnaire;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoriqueResource extends Resource
{
    protected static ?string $model = Historique::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date_payment')
                    ->label('Date de paiement')
                    ->required(),
                Forms\Components\Select::make('pensionnaire_id')
                    ->label('Pensionnaire')
                    ->options(Pensionnaire::all()->pluck('name', 'id'))
                    // ->relationship('pensionnaire', 'numCnaps')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('montant')
                    ->label('Montant')
                    ->integer()
                    ->required(),
                Forms\Components\Select::make('personnel_id')
                    ->label('Personnel')
                    ->options(User::all()->pluck('name', 'id'))
                    // ->relationship('personnel', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_payment')
                    ->label('Date de paiement')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pensionnaire.name')
                    ->label('Pensionnaire')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('montant')
                    ->label('Montant')
                    ->sortable(),
                Tables\Columns\TextColumn::make('personnel.name')
                    ->label('Personnel')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Ajoute ici des filtres si nécessaire
            ])
            ->actions([

            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistoriques::route('/'),
            // 'create' => Pages\CreateHistorique::route('/create'),
            // 'edit' => Pages\EditHistorique::route('/{record}/edit'),
        ];
    }    
}
