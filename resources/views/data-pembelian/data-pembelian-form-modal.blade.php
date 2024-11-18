<x-container.modal :name="$this->modal_name" :title="$this->title" method="save">

    <x-element.layout.vertical name="form.date" label="Date">
        <x-element.input.line type="date" wire:model="form.date" required=true />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.tipe_pembelian" label="Tipe Pembelian">
        <x-element.input.line required=true wire:model="form.tipe_pembelian" />
    </x-element.layout.vertical>

    <x-slot:button>
        <x-element.button.primary wire:loading.attr="disabled" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
