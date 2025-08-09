<?php

namespace App\Filament\Resources;

use App\Models\Property;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use App\Filament\Resources\PropertyResource\Pages;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Gestion des réservations';
    protected static ?string $pluralModelLabel = 'Propriétés';
    protected static ?string $modelLabel = 'Propriété';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nom')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->required()
                ->maxLength(65535),

            Forms\Components\TextInput::make('price_per_night')
                ->label('Prix par nuit (€)')
                ->required()
                ->numeric()
                ->minValue(0)
                ->step(0.01),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Nom')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('price_per_night')
                ->label('Prix par nuit (€)')
                ->money('eur')
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Créée le')
                ->dateTime()
                ->toggleable(isToggledHiddenByDefault: true),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}