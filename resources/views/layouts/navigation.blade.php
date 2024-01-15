<aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
    <div class="py-4 text-gray-500">
        <a class="ml-6 text-lg flex items-center font-bold text-gray-800" href="{{ route('dashboard') }}">
            <x-application-logo class="w-3/4 " />
        </a>



        <ul class="mt-6">

                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon">
                        <x-heroicon-o-home class="h-5 w-5" />
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-nav-link>



                @if(auth()->user()->isAdmin())
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                        <x-slot name="icon">
                            <x-heroicon-o-user-group class="h-5 w-5" />
                        </x-slot>
                        {{ __('Users') }}
                    </x-nav-link>

                @endif

                <x-nav-link href="{{ route('houses-report.index') }}" :active="request()->routeIs('houses-report.index')">
                    <x-slot name="icon">
                        <x-heroicon-o-cube class="h-5 w-5" />
                    </x-slot>
                    {{ __('Houses') }}
                </x-nav-link>

        </ul>
    </div>
</aside>
