<div>

    <x-element.button.primary class="rounded-lg" x-on:click="$dispatch('open-modal', {name: 'schedule-form-modal'})" >
        {{ __('Absensi') }}
    </x-element.button.primary>

    <livewire:schedule.schedule-form-modal />
    <x-placeholder.offline-states />
    <x-placeholder.loading-states />
</div>
