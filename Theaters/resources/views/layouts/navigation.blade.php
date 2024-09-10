<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('ホーム') }}
                    </x-nav-link>
                    <x-nav-link :href="route('theater.top')" :active="request()->routeIs('theater.top')">
                        {{ __('映画館') }}
                    </x-nav-link>
                    <x-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                         {{ __('映画') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reviews.create')" :active="request()->routeIs('reviews.create')">
                        {{ __('投稿') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <!-- ... (既存のコードをそのまま維持) ... -->

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('ホーム') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('theater.top')" :active="request()->routeIs('theater.top')">
                {{ __('映画館') }}
            </x-responsive-nav-link>
            <x-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.index')">
                {{ __('映画') }}
            </x-nav-link>
            <x-responsive-nav-link :href="route('reviews.create')" :active="request()->routeIs('reviews.create')">
                {{ __('投稿') }}
            </x-responsive-nav-link>
            
        </div>

        <!-- Responsive Settings Options -->
        <!-- ... (既存のコードをそのまま維持) ... -->

    </div>
</nav>