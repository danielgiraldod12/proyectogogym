<form action="{{route('updatepassword')}}" method="post">
    @csrf
    @method('put')
<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Actualizar Contraseña') }}
    </x-slot>

    <x-slot name="description">
        {{ __('No compartas tu contraseña con nadie.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="current_password" value="{{ __('Contraseña actual') }}" />
            <x-jet-input name="current_password" id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('Contraseña nueva') }}" />
            <x-jet-input name="password" id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
            <x-jet-input name="password_confirmation" id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button >
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
</form>
