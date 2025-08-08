<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public $properties;      // Liste des propriétés à réserver
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

        Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $this->selectedProperty,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        // Reset form fields
        $this->reset(['selectedProperty', 'start_date', 'end_date']);

        // Envoie un événement JS ou Livewire pour afficher un message de succès
        $this->dispatchBrowserEvent('notify', ['message' => 'Réservation créée avec succès !']);
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }
}