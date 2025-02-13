<div class="min-w-full align-middle">
    <form method="POST" wire:submit.prevent="update">
        @csrf

        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" required />
            <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Author -->
        <div class="mt-4">
            <x-input-label for="author" :value="__('Author')" required />
            <x-text-input wire:model="author" id="author" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('author')" class="mt-2" />
        </div>

        <!-- Publisher -->
        <div class="mt-4">
            <x-input-label for="publisher" :value="__('Publisher')" required />
            <x-text-input wire:model="publisher" id="publisher" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
        </div>

        <!-- Year of Publication -->
        <div class="mt-4">
            <x-input-label for="year_of_publication" :value="__('Year of Publication')" required />
            <x-text-input wire:model="year_of_publication" id="year_of_publication" class="block mt-1 w-full" type="number" required />
            <x-input-error :messages="$errors->get('year_of_publication')" class="mt-2" />
        </div>

        <!-- ISBN -->
        <div class="mt-4">
            <x-input-label for="isbn" :value="__('ISBN')" required />
            <x-text-input wire:model="isbn" id="isbn" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
        </div>

        <!-- Quantity Available -->
        <div class="mt-4">
            <x-input-label for="quantity_available" :value="__('Quantity Available')" required />
            <x-text-input wire:model="quantity_available" id="quantity_available" class="block mt-1 w-full" type="number" required />
            <x-input-error :messages="$errors->get('quantity_available')" class="mt-2" />
        </div>

        <!-- Description -->
        <div
            x-data="{
                description: @entangle('description')
            }"
            class="mt-4"
        >
            <x-input-label for="description" :value="__('Description')" required />
            <textarea wire:model="description" x-model="description" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            <div class="flex justify-end mt-1 text-sm text-gray-500">
                <span x-text="description ? description.length : 0">0</span>/1000 characters
            </div>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Location -->
        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" required />
            <x-text-input wire:model="location" id="location" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</div>
