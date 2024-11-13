<x-container.modal name="schedule-form-modal" :title="$this->title" method="save">

    <x-element.layout.vertical name="form.shift" label="Shift">
        <x-element.input.line wire:model="form.shift" required=true />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.date" label="Date">
        <x-element.input.line type="date" wire:model="form.date" required=true />
    </x-element.layout.vertical>
    <x-element.select.checkbox name="form.absen" required=true label="Absen" wire:model="form.absen" />
    <x-slot:button>
        <x-element.button.primary class="rounded-lg" wire:loading.attr="disabled" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
