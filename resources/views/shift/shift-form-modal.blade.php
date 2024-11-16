<x-container.modal :name="$this->modal_name" :title="$this->title" method="save">

    <x-element.layout.vertical name="form.nama_shift" label="Nama Shift">
        <x-element.input.line wire:model="form.nama_shift" required=true />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.start" label="Start">
        <x-element.input.line type="time" wire:model="form.start" required=true />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.end" label="End">
        <x-element.input.line type="time" wire:model="form.end" required=true />
    </x-element.layout.vertical>
    <x-slot:button>
        <x-element.button.primary class="rounded-lg" wire:loading.attr="disabled" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
