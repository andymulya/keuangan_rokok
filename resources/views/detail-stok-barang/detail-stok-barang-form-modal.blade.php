<x-container.modal :name="$this->modal_name" :title="$this->title" method="save">

    <x-element.layout.vertical name="form.stok_name" label="Nama Stok">
        <x-element.input.line wire:model="form.stok_name" required=true />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.jumlah" label="Jumlah">
        <x-element.input.line required=true wire:model="form.jumlah" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.harga_satuan" label="Harga Satuan">
        <x-element.input.line type="number" required="true" min=0 wire:model="form.harga_satuan" />
    </x-element.layout.vertical>

    <x-slot:button>
        <x-element.button.primary wire:loading.attr="disabled" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
