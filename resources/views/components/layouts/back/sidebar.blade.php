<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard.index') }}" class="brand-link">
            <img src="{{ asset('assets/images/Logo.jpeg') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow rounded-circle" width="50" />
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                <x-ui.button type="navLink" :url="route('admin.dashboard.index')" title="Dashboard" icon="bi bi-speedometer"
                    path="admin/dashboard" />

                <li class="nav-header">Daftar Menu</li>
                <x-ui.button type="navLink" :url="route('category.index')" title="Kategori" icon="bi bi-tag" path="admin/category" />

                <x-ui.button type="navLink" :url="route('berita.index')" title="Berita" icon="bi bi-newspaper"
                    path="admin/berita*" />

                <x-ui.button type="navLink" :url="route('produk.index')" title="Produk" icon="bi bi-clipboard-data"
                    path="admin/produk*" />

                <x-ui.button type="navLink" :url="route('order.index')" title="Order" icon="bi bi-cart-plus"
                    path="admin/order" />

                <x-ui.button type="navLink" :url="route('dudi.index')" title="Dudi" icon="bi bi-person" path="admin/dudi" />

                @if (Auth::user()->role === 'admin')
                    <li class="nav-header">Pengaturan</li>
                    <x-ui.button type="navLink" :url="route('struktur.index')" title="Struktur Organisasi" icon="bi bi-pip"
                        path="admin/struktur*" />

                    <x-ui.button type="navLink" :url="route('vm.index')" title="Visi & Misi" icon="bi bi-book"
                        path="admin/vm*" />

                    <x-ui.button type="navLink" :url="route('slider.index')" title="Slider" icon="bi bi-camera"
                        path="admin/slider" />

                    <li class="nav-header">Pengguna</li>
                    <x-ui.button type="navLink" :url="route('user.index')" title="Pengguna" icon="bi bi-people"
                        path="admin/user" />
                @endif

            </ul>
        </nav>
    </div>
</aside>
