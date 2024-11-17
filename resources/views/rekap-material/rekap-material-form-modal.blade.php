<x-container.modal :name="$this->modal_name" :title="$this->title" method="save">

    <x-element.layout.vertical name="form.date" label="Date">
        <x-element.input.line type="date" wire:model="form.date" required=true />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.tipe_rekap" label="Tipe Rekap">
        <x-element.input.line required="true" wire:model="form.tipe_rekap" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.nama_material" label="Nama Material">
        <x-element.input.line required="true" wire:model="form.nama_material" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.persediaan" label="Persediaan">
        <x-element.input.line type="number" step="0.01" required="true" min=0 wire:model="form.persediaan" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.pemakaian" label="Pemakaian">
        <x-element.input.line type="number" step="0.01" required="true" min=0 wire:model="form.pemakaian" />
    </x-element.layout.vertical>
    {{-- <x-element.layout.vertical name="form.sisa" label="Sisa">
        <x-element.input.line type="number" step="0.01" required="true" wire:model="form.sisa" />
    </x-element.layout.vertical> --}}
    <x-element.layout.vertical name="form.harga_satuan" label="Harga Satuan">
        <x-element.input.line type="number" required="true" min=0 wire:model="form.harga_satuan" />
    </x-element.layout.vertical>
    {{-- <x-element.layout.vertical name="form.total" label="Total">
        <x-element.input.line type="number" step="0.01" required="true" wire:model="form.total" />
    </x-element.layout.vertical> --}}

    <x-slot:button>
        <x-element.button.primary wire:loading.attr="disabled" class="rounded-lg" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
