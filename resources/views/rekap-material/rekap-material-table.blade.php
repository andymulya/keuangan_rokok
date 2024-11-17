<x-container.card :$title :permission="$permissions['create']" :modal="$modals['create']" :$search>
    <!-- Dropdown tipe rekap -->
    <x-element.layout.vertical name="tipe_rekap_selected" label="Tipe Rekap">
        <x-element.select.dropdown class="w-[150px]" required=true wire:model.live="tipe_rekap_selected">
            <option value="reguler">Reguler</option>
            <option value="mild">Mild</option>
        </x-element.select.dropdown>
    </x-element.layout.vertical>

    <x-element.table :$cols :rows="$this->rows" :$sort_direction :$sort_by :$permissions :$modals :$import :$export />

    <livewire:rekap-material.rekap-material-form-modal />
    <x-placeholder.offline-states />
    <x-placeholder.loading-states />
</x-container.card>
