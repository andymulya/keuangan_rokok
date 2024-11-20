<x-container.modal :name="$this->modal_name" :title="$this->title" method="save">

    <!-- Dropdown Type -->
    <div class="flex flex-col">
        <x-element.layout.vertical name="form.type" label="Tipe Data">
            <x-element.select.dropdown required=true wire:model.live="form.type">
                <option value="reguler">Reguler</option>
                <option value="mild">Mild</option>
            </x-element.select.dropdown>
        </x-element.layout.vertical>
    </div>

    <!-- Dropdown Date -->
    <div class="flex flex-col">
        <x-element.layout.vertical name="form.date" label="Date">

            <x-element.select.dropdown required=true wire:model.live="form.date">
                <option value="{{ null }}">-- Pilih Tanggal --</option>
                @foreach (App\Models\DataPembelianBarang::getDataWithType($this->form->type) as $data)
                    <option value="{{$data['date']}}">{{ $data["date"] }}</option>
                @endforeach
            </x-element.select.dropdown>
        </x-element.layout.vertical>
    </div>

    <x-element.layout.vertical name="form.stok_name" label="Nama Stok">
        <x-element.input.line wire:model="form.stok_name" required=true />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.jumlah" label="Jumlah">
        <x-element.input.line type="number" required=true min=0 wire:model="form.jumlah" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.harga_satuan" label="Harga Satuan">
        <x-element.input.line type="number" required="true" min=0 wire:model="form.harga_satuan" />
    </x-element.layout.vertical>

    <x-slot:button>
        <x-element.button.primary wire:loading.attr="disabled" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
