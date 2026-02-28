<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-table"></i>
        </div>
        <div class="sidebar-brand-text mx-3">RCH CMS<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard')?'active':'' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    @php
    $menus = \App\Models\Menu::with('children')
        ->whereNull('parent_id')
        ->where('is_active',1)
        ->orderBy('order')
        ->get();
    @endphp

    @foreach($menus as $menu)

        @if($menu->children->count())

            @can($menu->permission_name)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                data-target="#menu{{ $menu->id }}">
                    <i class="{{ $menu->icon }}"></i>
                    <span>{{ $menu->name }}</span>
                </a>

                <div id="menu{{ $menu->id }}" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">

                        @foreach($menu->children as $child)

                            @can($child->permission_name)
                            <a class="collapse-item" href="{{ route($child->route) }}">
                                {{ $child->name }}
                            </a>
                            @endcan

                        @endforeach

                    </div>
                </div>
            </li>
            @endcan

        @else

            @can($menu->permission_name)
            <li class="nav-item">
                <a class="nav-link" href="{{ route($menu->route) }}">
                    <i class="{{ $menu->icon }}"></i>
                    <span>{{ $menu->name }}</span>
                </a>
            </li>
            @endcan

        @endif

    @endforeach

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block my-2">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>