<x-container.modal name="schedule-form-modal" :title="$this->title" method="save">

    <!-- Dropdown User -->
    <div class="flex flex-col">
        <x-element.layout.vertical name="form.user_id" label="User">
            <x-element.select.dropdown required=true wire:model="form.user_id">
                <option value="{{ null }}">-- Pilih User --</option>
                @foreach (App\Models\User::all() as $user)
                    <option value="{{$user['id']}}">{{ $user["name"] }}</option>
                @endforeach
            </x-element.select.dropdown>
        </x-element.layout.vertical>

    </div>

    <!-- Dropdown Shift -->
    <div class="flex flex-col">
        <x-element.layout.vertical name="form.shift_id" label="Shift">

            <x-element.select.dropdown required=true wire:model="form.shift_id">
                <option value="{{ null }}">-- Pilih Shift --</option>
                @foreach (App\Models\Shift::all() as $shift)
                    <option value="{{$shift['id']}}">{{ $shift["nama_shift"] }}</option>
                @endforeach
            </x-element.select.dropdown>
        </x-element.layout.vertical>
    </div>

    <x-element.layout.vertical name="form.date" label="Date">
        <x-element.input.line type="date" wire:model="form.date" required=true />
    </x-element.layout.vertical>
    <x-slot:button>
        <x-element.button.primary class="rounded-lg" wire:loading.attr="disabled" type="submit">Save</x-element.button.primary>
    </x-slot:button>
</x-container.modal>
