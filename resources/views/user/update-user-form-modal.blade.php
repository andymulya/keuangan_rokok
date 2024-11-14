<x-container.modal :name="$this->modal_name" :title="$this->title" method="save">

    <x-element.layout.vertical name="form.name" label="Name">
        <x-element.input.line wire:model="form.name" />
    </x-element.layout.vertical>
    <x-element.layout.vertical name="form.email" label="Email">
        <x-element.input.line wire:model="form.email" />
    </x-element.layout.vertical>

    <x-element.select.dropdown wire:model.change="form.role">
        @foreach (App\Models\Role::all() as $role)
            <option value="{{$role['id']}}">{{ $role["name"] }}</option>
        @endforeach
    </x-element.select.dropdown>

    <x-slot:button>
        <x-element.button.primary wire:loading.attr="disabled" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
