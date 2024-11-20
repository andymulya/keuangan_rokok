<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-layouts.partials.application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-layouts.partials.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-layouts.partials.nav-link>
                    @can('user index')
                        <x-layouts.partials.nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                            {{ __('Users') }}
                        </x-layouts.partials.nav-link>
                    @endcan
                    @can('role index')
                        <x-layouts.partials.nav-link :href="route('role.index')" :active="request()->routeIs('role.index')">
                            {{ __('Roles') }}
                        </x-layouts.partials.nav-link>
                    @endcan
                    @can('schedule index')
                    <x-layouts.partials.nav-link :href="route('schedule.index')" :active="request()->routeIs('schedule.index')">
                            {{ __('Schedule') }}
                        </x-layouts.partials.nav-link>
                    @endcan
                    @can('shift index')
                    <x-layouts.partials.nav-link :href="route('shift.index')" :active="request()->routeIs('shift.index')">
                        {{ __('Shift') }}
                    </x-layouts.partials.nav-link>
                    @endcan
                    @can('operator index')
                        <x-layouts.partials.nav-link :href="route('operator.index')" :active="request()->routeIs('operator.index')">
                            {{ __('Operator') }}
                        </x-layouts.partials.nav-link>
                    @endcan
                    @can('rekap-material index')
                        <x-layouts.partials.nav-link :href="route('rekap-material.index')" :active="request()->routeIs('rekap-material.index')">
                            {{ __('Rekap Material') }}
                        </x-layouts.partials.nav-link>
                    @endcan
                    @can('data-pembelian index')
                        <x-layouts.partials.nav-link :href="route('data-pembelian.index')" :active="request()->routeIs('data-pembelian.index')">
                            {{ __('Data Pembelian') }}
                        </x-layouts.partials.nav-link>
                    @endcan
                    @can('detail-stok index')
                        <x-layouts.partials.nav-link :href="route('detail-stok.index')" :active="request()->routeIs('detail-stok.index')">
                            {{ __('Detail Stok') }}
                        </x-layouts.partials.nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-element.dropdown.container align="right" width="48">
                    <x-slot:trigger>
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot:trigger>

                    <x-slot:content>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-element.dropdown.link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-element.dropdown.link>
                        </form>
                    </x-slot:content>
                </x-element.dropdown.container>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-layouts.partials.responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-layouts.partials.responsive-nav-link>
            @can('user index')
                <x-layouts.partials.responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                    {{ __('Users') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
            @can('role index')
                <x-layouts.partials.responsive-nav-link :href="route('role.index')" :active="request()->routeIs('role.index')">
                    {{ __('Roles') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
            @can('schedule index')
                <x-layouts.partials.responsive-nav-link :href="route('schedule.index')" :active="request()->routeIs('schedule.index')">
                    {{ __('Schedule') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
            @can('shift index')
                <x-layouts.partials.responsive-nav-link :href="route('shift.index')" :active="request()->routeIs('shift.index')">
                    {{ __('Shift') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
            @can('operator index')
                <x-layouts.partials.responsive-nav-link :href="route('operator.index')" :active="request()->routeIs('operator.index')">
                    {{ __('Operator') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
            @can('rekap-material index')
                <x-layouts.partials.responsive-nav-link :href="route('rekap-material.index')" :active="request()->routeIs('rekap-material.index')">
                    {{ __('Rekap Material') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
            @can('data-pembelian index')
                <x-layouts.partials.responsive-nav-link :href="route('data-pembelian.index')" :active="request()->routeIs('data-pembelian.index')">
                    {{ __('Data Pembelian') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
            @can('detail-stok index')
                <x-layouts.partials.responsive-nav-link :href="route('detail-stok.index')" :active="request()->routeIs('detail-stok.index')">
                    {{ __('Detail Stok') }}
                </x-layouts.partials.responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-layouts.partials.responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-layouts.partials.responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
