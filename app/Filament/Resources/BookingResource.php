<?php

namespace App\Filament\Resources;

use App\Models\Booking;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use App\Filament\Resources\BookingResource\Pages;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Gestion des réservations';
    protected static ?string $pluralModelLabel = 'Réservations';
    protected static ?string $modelLabel = 'Réservation';

    // <-- Notez Forms\Form et le retour Forms\Form
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('property_id')
                    ->label('Propriété')
                    ->relationship('property', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Date de début')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Date de fin')
                    ->required()
                    ->after('start_date'),
            ]);
    }

    // <-- Notez Tables\Table et le retour Tables\Table
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('property.name')
                    ->label('Propriété')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Début')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Fin')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créée le')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('future')
                    ->label('Réservations à venir')
                    ->query(fn ($query) => $query->where('start_date', '>=', now())),
            ])
            ->defaultSort('start_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}