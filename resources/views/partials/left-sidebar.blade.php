<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Minato</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($menus as $menu)
                <li class="nav-item">
                    <a href="{{ $menu['route'] }}" class="nav-link  @if(isset($menu['active']))active @endif">
                        <i class="{{ $menu['icon'] }} nav-icon"></i>
                        <p>{{ $menu['text'] }}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>