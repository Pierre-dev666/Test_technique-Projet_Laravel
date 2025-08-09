<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public $properties;
    public $selectedProperty = null;
    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->properties = Property::all();
    }

    public function book()
    {
        $this->validate([
            'selectedProperty' => 'required|exists:properties,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Vérifier si la propriété est déjà réservée sur la période choisie
        $overlap = Booking::where('property_id', $this->selectedProperty)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                    ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
                    ->orWhere(function ($query) {
                        $query->where('start_date', '<=', $this->start_date)
                            ->where('end_date', '>=', $this->end_date);
                    });
            })
            ->exists();

        if ($overlap) {
            session()->flash('error', '⚠️ Cette propriété est déjà réservée sur cette période.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $this->selectedProperty,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->reset(['selectedProperty', 'start_date', 'end_date']);

        session()->flash('message', '✅ Réservation créée avec succès !');
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }
}
