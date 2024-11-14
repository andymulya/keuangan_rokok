@props([
    'title' => '',
    'permission' => false,
    'search' => null,
    'modal' => null,
])

<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white shadow-sm rounded-2xl">
        <div class="p-6 text-gray-900">
            <div class="flex flex-col items-center justify-between gap-5 mb-3 md:flex-row">
                <h2 class="text-2xl font-bold">{{ __($title) }}</h2>
                <div class="flex gap-1">
                    @if (isset($search))
                        <x-element.input.line wire:model.live="search" styles="rounded-full" placeholder="Search..." />
                    @endif

                    @if ($permission && isset($modal))
                        @if (App\Models\Schedule::getScheduleDateNowUser())
                            @if (auth()->user()->roles->first()->name == App\Models\Role::OPERATOR && App\Models\Schedule::getScheduleDateNowUser()->date == getDateNow())
                                <x-element.button.primary class="rounded-full"
                                    x-on:click="$dispatch('open-modal', {name: '{{ $modal }}'})">
                                    <x-heroicon-s-plus width="16" />
                                </x-element.button.primary>
                            @endif
                        @endif

                        @if (auth()->user()->roles->first()->name != App\Models\Role::OPERATOR && auth()->user()->roles->first()->name != App\Models\Role::ADMIN)
                            <x-element.button.primary class="rounded-full"
                                x-on:click="$dispatch('open-modal', {name: '{{ $modal }}'})">
                                <x-heroicon-s-plus width="16" />
                            </x-element.button.primary>
                        @endif
                    @endif
                </div>
            </div>
            <div class="block">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
