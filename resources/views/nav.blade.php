<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                @auth
                    {{-- Enlaces usuarios logueados --}}
                    <x-nav-link href="{{route('dashboard')}}" :active="request()->routeIs('dashboard')">
                        {{__('Dashboard')}}
                    </x-nav-link>
                @else
                    {{-- Enlaces usuarios no logueados --}}
                    <x-nav-link href="{{route('login')}}" :active="request()->routeIs('login')">
                        {{__('Log in')}}
                    </x-nav-link>
                    <x-nav-link href="{{route('register')}}" :active="request()->routeIs('register')">
                        {{__('Register')}}
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>

  