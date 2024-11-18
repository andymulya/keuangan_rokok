<x-container.card :$title :permission="$permissions['create']" :modal="$modals['create']">

    <div class="flex flex-row gap-2">
        <!-- Dropdown tipe -->
        <x-element.layout.vertical name="tipe_data_selected" label="Tipe Data">
            <x-element.select.dropdown required=true wire:model.live="tipe_data_selected">
                <option value="reguler">Reguler</option>
                <option value="mild">Mild</option>
            </x-element.select.dropdown>
        </x-element.layout.vertical>

        {{-- Date --}}
        <x-element.layout.vertical name="data_date" label="Date">
            <x-element.input.line type="date" wire:model.live="data_date" />
        </x-element.layout.vertical>
    </div>
    <x-element.table :$cols :rows="$this->rows" :$sort_direction :$sort_by :$permissions :$modals :$import :$export />

    <livewire:data-pembelian.data-pembelian-form-modal />
    <x-placeholder.offline-states />
    <x-placeholder.loading-states />
</x-container.card>
