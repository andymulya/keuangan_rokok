<x-container.modal :name="$this->modal_name" :title="$this->title" method="save">

    <x-element.layout.vertical name="form.lb_black" label="LB Black">
        <x-element.input.line type="number" step="0.01" required="true" wire:model="form.lb_black" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.bat" label="BAT">
        <x-element.input.line type="number" step="0.01" required="true" wire:model="form.bat" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.pem" label="PEM">
        <x-element.input.line type="number" step="0.01" required="true" wire:model="form.pem" />
    </x-element.layout.vertical>

    <x-slot:button>
        <x-element.button.primary wire:loading.attr="disabled" class="rounded-lg" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
