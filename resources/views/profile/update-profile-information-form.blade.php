@if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form method="POST" action="{{ route('updateprofile') }}">
    @csrf
    @method('put')
<x-jet-form-section submit="updateprofilea">
    <x-slot name="title">
        {{ __('Informacion de Usuario') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza el nombre y el correo electronico de tu cuenta') }}
    </x-slot>

    <x-slot name="form">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nombre') }}" />
            <x-jet-input name="name" id="name" type="text" class="mt-1 block w-full" value="{{Auth()->user()->name}}" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input name="email" id="email" type="email" class="mt-1 block w-full" value="{{Auth()->user()->email}}" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
</form>
