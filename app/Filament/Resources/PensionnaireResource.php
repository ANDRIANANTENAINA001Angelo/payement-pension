<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PensionnaireResource\Pages;
use App\Filament\Resources\PensionnaireResource\RelationManagers;
use App\Models\Pensionnaire;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PensionnaireResource extends Resource
{
    protected static ?string $model = Pensionnaire::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nom')
                ->required(),
                Forms\Components\TextInput::make('numCnaps')
                    ->label('Numéro CNAPS')
                    ->required(),
                Forms\Components\TextInput::make('cin')
                    ->label('CIN')
                    ->required(),
                Forms\Components\TextInput::make('numMatricule')
                    ->label('Numéro Matricule')
                    ->required(),
                Forms\Components\TextInput::make('solde')
                    ->label('Solde')
                    ->integer()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()
                ->label('Nom'),
                Tables\Columns\TextColumn::make('numCnaps')->searchable()
                    ->label('Numéro CNAPS'),
                Tables\Columns\TextColumn::make('cin')
                    ->label('CIN')->searchable(),
                Tables\Columns\TextColumn::make('numMatricule')
                    ->label('Numéro Matricule')->searchable(),
                Tables\Columns\TextColumn::make('solde')
                    ->label('Solde'),
            ])
            ->filters([
                
            ])
            ->actions([

                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('payer')
                    ->label('Payer')
                    ->icon('heroicon-o-currency-dollar')
                    ->url(fn (Pensionnaire $record) => route('filament.resources.pensionnaires.pay', $record))
                    ->color('success'),
            ]);
             // Ajoute la fonctionnalité de recherche

            
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
            'index' => Pages\ListPensionnaires::route('/'),
            // 'create' => Pages\CreatePensionnaire::route('/create'),
            // 'edit' => Pages\EditPensionnaire::route('/{record}/edit'),
            'pay' => Pages\PayPensionnaire::route('/{record}/pay'),
        ];
    }    
}
