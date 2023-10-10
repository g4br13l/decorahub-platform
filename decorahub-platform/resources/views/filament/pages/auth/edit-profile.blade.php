

{{--<x-filament-panels::page.simple>--}}


<div class="my-16">
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

</div>

{{--</x-filament-panels::page.simple>--}}
