<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-lg"
                        style="background-color: var(--primary-blue);">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="logo poliwangi">
                    </div>
                    <span class="ml-3 text-xl font-semibold" style="color: var(--primary-blue);">
                        PPID Poliwangi
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-6">
                    @foreach ($menus->where('is_active', true) as $menu)
                        @if ($menu->has_children)
                            <!-- Filter active children only -->
                            @php
                                $activeChildren = $menu->children->where('is_active', true);
                            @endphp

                            @if ($activeChildren->count() > 0)
                                <!-- Menu with Dropdown -->
                                <div class="relative group">
                                    @php
                                        $hasActiveChild = false;
                                        foreach ($activeChildren as $child) {
                                            if ($child->route_name && request()->routeIs($child->route_name)) {
                                                $hasActiveChild = true;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <button
                                        class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-gray-700 hover:text-white hover:bg-opacity-80 flex items-center"
                                        onmouseover="this.style.backgroundColor='var(--primary-blue)'"
                                        onmouseout="this.style.backgroundColor=''">
                                        {{ $menu->title }}
                                        <svg class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:rotate-180"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div
                                        class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                        <div class="py-1">
                                            @foreach ($activeChildren as $child)
                                                @php
                                                    $isChildActive = $child->route_name
                                                        ? request()->routeIs($child->route_name)
                                                        : false;
                                                    $routeExists = $child->route_name
                                                        ? Route::has($child->route_name)
                                                        : false;
                                                    $childActualUrl = $routeExists ? $child->actual_url : '#';
                                                    $childClass = $routeExists
                                                        ? ($isChildActive
                                                            ? ''
                                                            : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900')
                                                        : 'text-gray-400 cursor-not-allowed';
                                                    $childTitle = $routeExists ? '' : 'title="Route tidak tersedia"';
                                                    $childTag = $routeExists ? 'a' : 'span';
                                                    $childHref = $routeExists ? "href=\"{$childActualUrl}\"" : '';
                                                    $childOnclick = $routeExists ? '' : 'onclick="return false;"';
                                                @endphp

                                                <{{ $childTag }} {!! $childHref !!} {!! $childOnclick !!}
                                                    class="block px-4 py-2 text-sm {{ $childClass }} transition-colors duration-150"
                                                    {!! $childTitle !!}>
                                                    {{ $child->title }}
                                                    </{{ $childTag }}>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- If parent has no active children, show as single item if it has a valid route -->
                                @php
                                    $isActive = $menu->route_name ? request()->routeIs($menu->route_name) : false;
                                    $routeExists = $menu->route_name ? Route::has($menu->route_name) : false;
                                @endphp

                                @if ($routeExists)
                                    <a href="{{ $menu->actual_url }}"
                                        class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ $isActive ? 'text-white' : 'text-gray-700 hover:text-white hover:bg-opacity-80' }}"
                                        style="{{ $isActive ? 'background-color: var(--primary-blue);' : '' }}"
                                        onmouseover="if(!this.classList.contains('text-white')) this.style.backgroundColor='var(--primary-blue)'"
                                        onmouseout="if(!this.classList.contains('text-white')) this.style.backgroundColor=''">
                                        {{ $menu->title }}
                                    </a>
                                @else
                                    <span
                                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-400 cursor-not-allowed"
                                        title="Menu tidak tersedia">
                                        {{ $menu->title }}
                                    </span>
                                @endif
                            @endif
                        @else
                            <!-- Single Menu Item -->
                            @php
                                $isActive = $menu->route_name ? request()->routeIs($menu->route_name) : false;
                                $routeExists = $menu->route_name ? Route::has($menu->route_name) : false;
                            @endphp

                            @if ($routeExists)
                                <a href="{{ $menu->actual_url }}"
                                    class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ $isActive ? 'text-white' : 'text-gray-700 hover:text-white hover:bg-opacity-80' }}"
                                    style="{{ $isActive ? 'background-color: var(--primary-blue);' : '' }}"
                                    onmouseover="if(!this.classList.contains('text-white')) this.style.backgroundColor='var(--primary-blue)'"
                                    onmouseout="if(!this.classList.contains('text-white')) this.style.backgroundColor=''">
                                    {{ $menu->title }}
                                </a>
                            @else
                                <span class="px-3 py-2 rounded-md text-sm font-medium text-gray-400 cursor-not-allowed"
                                    title="Menu tidak tersedia">
                                    {{ $menu->title }}
                                </span>
                            @endif
                        @endif
                    @endforeach

                    <!-- Login Button (Static - keep as is) -->
                    <a href="{{ route('home.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-gray-700 hover:text-white hover:bg-opacity-80"
                        onmouseover="this.style.backgroundColor='var(--primary-blue)'"
                        onmouseout="this.style.backgroundColor=''">
                        Login
                    </a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    style="hover:background-color: var(--primary-blue);" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
            @foreach ($menus->where('is_active', true) as $menu)
                @if ($menu->has_children)
                    <!-- Filter active children only -->
                    @php
                        $activeChildren = $menu->children->where('is_active', true);
                    @endphp

                    @if ($activeChildren->count() > 0)
                        <!-- Mobile Menu with Submenu -->
                        <div class="block">
                            <button onclick="toggleSubmenu('{{ $menu->id }}')"
                                class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 flex items-center justify-between">
                                {{ $menu->title }}
                                <svg id="{{ $menu->id }}-arrow" class="h-4 w-4 transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                            <div id="{{ $menu->id }}-submenu" class="hidden pl-6 space-y-1">
                                @foreach ($activeChildren as $child)
                                    @php
                                        $routeExists = $child->route_name ? Route::has($child->route_name) : false;
                                        $isChildActive = $child->route_name
                                            ? request()->routeIs($child->route_name)
                                            : false;
                                        $childActualUrl = $routeExists ? $child->actual_url : '#';
                                        $childClass = $routeExists
                                            ? ($isChildActive
                                                ? ''
                                                : 'text-gray-600 hover:text-gray-900')
                                            : 'text-gray-400 cursor-not-allowed';
                                        $childTitle = $routeExists ? '' : 'title="Route tidak tersedia"';
                                        $childTag = $routeExists ? 'a' : 'span';
                                        $childHref = $routeExists ? "href=\"{$childActualUrl}\"" : '';
                                        $childOnclick = $routeExists ? '' : 'onclick="return false;"';
                                    @endphp

                                    <{{ $childTag }} {!! $childHref !!} {!! $childOnclick !!}
                                        class="block px-3 py-2 text-sm {{ $childClass }} rounded"
                                        {!! $childTitle !!}>
                                        {{ $child->title }}
                                        </{{ $childTag }}>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- If parent has no active children, show as single item if it has a valid route -->
                        @php
                            $isActive = $menu->route_name ? request()->routeIs($menu->route_name) : false;
                            $routeExists = $menu->route_name ? Route::has($menu->route_name) : false;
                            $actualUrl = $routeExists ? $menu->actual_url : '#';
                            $menuClass = $routeExists
                                ? ($isActive
                                    ? ''
                                    : 'text-gray-700')
                                : 'text-gray-400 cursor-not-allowed';
                            $menuTitle = $routeExists ? '' : 'title="Menu tidak tersedia"';
                            $menuTag = $routeExists ? 'a' : 'span';
                            $menuHref = $routeExists ? "href=\"{$actualUrl}\"" : '';
                            $menuOnclick = $routeExists ? '' : 'onclick="return false;"';
                        @endphp

                        <{{ $menuTag }} {!! $menuHref !!} {!! $menuOnclick !!}
                            class="block px-3 py-2 rounded-md text-base font-medium {{ $menuClass }}"
                            {!! $menuTitle !!}>
                            {{ $menu->title }}
                            </{{ $menuTag }}>
                    @endif
                @else
                    <!-- Single Mobile Menu Item -->
                    @php
                        $isActive = $menu->route_name ? request()->routeIs($menu->route_name) : false;
                        $routeExists = $menu->route_name ? Route::has($menu->route_name) : false;
                        $actualUrl = $routeExists ? $menu->actual_url : '#';
                        $menuClass = $routeExists
                            ? ($isActive
                                ? ''
                                : 'text-gray-700')
                            : 'text-gray-400 cursor-not-allowed';
                        $menuTitle = $routeExists ? '' : 'title="Menu tidak tersedia"';
                        $menuTag = $routeExists ? 'a' : 'span';
                        $menuHref = $routeExists ? "href=\"{$actualUrl}\"" : '';
                        $menuOnclick = $routeExists ? '' : 'onclick="return false;"';
                    @endphp

                    <{{ $menuTag }} {!! $menuHref !!} {!! $menuOnclick !!}
                        class="block px-3 py-2 rounded-md text-base font-medium {{ $menuClass }}"
                        {!! $menuTitle !!}>
                        {{ $menu->title }}
                        </{{ $menuTag }}>
                @endif
            @endforeach

            <!-- Mobile Login Button -->
            <a href="{{ route('home.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-blue-50">
                Login
            </a>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    function toggleSubmenu(menuId) {
        const submenu = document.getElementById(menuId + '-submenu');
        const arrow = document.getElementById(menuId + '-arrow');

        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>
