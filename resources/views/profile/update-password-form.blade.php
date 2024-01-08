<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Opdater password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Vær sikker på at vælge et langt og unikt password.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Nuværende password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Nyt password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Bekræft password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Gemt.') }}
        </x-action-message>

        <x-button class="bg-primary-color border border-transparent rounded-md font-semibold text-xs text-secondary-color uppercase tracking-widest focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-vestegns-deep-blues focus:ring-offset-2 transition ease-in-out duration-150">
            {{ __('Gem') }}
        </x-button>
    </x-slot>
</x-form-section>
