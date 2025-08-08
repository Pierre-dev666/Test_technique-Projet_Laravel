<div class="p-6 bg-white rounded shadow max-w-md mx-auto">

    <h2 class="text-xl font-bold mb-4">Réserver une propriété</h2>

    <div class="mb-4">
        <label for="property" class="block mb-1">Propriété</label>
        <select wire:model="selectedProperty" id="property" class="w-full border rounded px-3 py-2">
            <option value="">-- Choisissez une propriété --</option>
            @foreach ($properties as $property)
                <option value="{{ $property->id }}">{{ $property->name }} - {{ number_format($property->price_per_night, 2) }} € / nuit</option>
            @endforeach
        </select>
        @error('selectedProperty') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="start_date" class="block mb-1">Date de début</label>
        <input wire:model="start_date" type="date" id="start_date" class="w-full border rounded px-3 py-2" />
        @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="end_date" class="block mb-1">Date de fin</label>
        <input wire:model="end_date" type="date" id="end_date" class="w-full border rounded px-3 py-2" />
        @error('end_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <button wire:click="book" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/80">Réserver</button>

    <script>
        window.addEventListener('notify', event => {
            alert(event.detail.message);
        });
    </script>
</div>