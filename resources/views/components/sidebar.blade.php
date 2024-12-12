<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column" id="sidebar">
        <a href="" id="sidepanel-close" class="sidepanel-close"><i class="fa-solid fa-xmark"></i></a>
        <div class="app-branding">
            <a class="app-logo d-flex align-items-center" href="/">
                <img class="logo-icon " src="{{ asset('assets/images/logofood.png') }}" alt="logo">
                <img class="logo-icon-text " src="{{ asset('assets/images/logo-warkop-sahabat.png') }}" alt="logotext"
                    style="width: 75%; padding-left: -15px">
            </a>
        </div>
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1 mt-3">
            <ul class="app-menu list-unstyled accordion">

                {{-- dashboard  --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                        <span class="nav-icon">
                            <i class="fa-solid fa-house-chimney"></i>
                        </span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                {{-- karyawan --}}
                @can('admin')
                    <li class="nav-item has-submenu">
                        <a class="nav-link submenu-toggle {{ Request::is('karyawan') ? 'active' : (Request::is('karyawan/create') ? 'active' : '') }}"
                            data-bs-toggle="collapse" data-bs-target="#submenu-3"
                            aria-expanded="{{ Request::is('karyawan') ? 'true' : (Request::is('karyawan/create') ? 'true' : 'false') }}"
                            aria-controls="submenu-3" role="button">
                            <span class="nav-icon">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <span class="nav-link-text">Karyawan</span>
                            <span class="submenu-arrow">
                                <i class="fa-solid fa-chevron-down arrow"></i>
                            </span>
                        </a>
                        <div id="submenu-3"
                            class="submenu submenu-3 {{ Request::is('karyawan') ? 'collapse show' : (Request::is('karyawan/create') ? 'collapse show' : 'collapse') }}"
                            data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('karyawan') ? 'active' : '' }}"
                                        href="{{ route('karyawan.index') }}">Kelola Karyawan</a></li>
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('karyawan/create') ? 'active' : '' }}"
                                        href="{{ route('karyawan.create') }}">Tambah Karyawan Baru</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- kategori --}}
                @can('admin')
                    <li class="nav-item has-submenu">
                        <a class="nav-link submenu-toggle {{ Request::is('kategori') ? 'active' : (Request::is('kategori/create') ? 'active' : '') }}"
                            data-bs-toggle="collapse" data-bs-target="#submenu-4"
                            aria-expanded="{{ Request::is('kategori') ? 'true' : (Request::is('kategori/create') ? 'true' : 'false') }}"
                            aria-controls="submenu-4" role="button">
                            <span class="nav-icon">
                                <i class="fa-solid fa-cube"></i>
                            </span>
                            <span class="nav-link-text">Kategori</span>
                            <span class="submenu-arrow">
                                <i class="fa-solid fa-chevron-down arrow"></i>
                            </span>
                        </a>
                        <div id="submenu-4"
                            class="submenu submenu-4 {{ Request::is('kategori') ? 'collapse show' : (Request::is('kategori/create') ? 'collapse show' : 'collapse') }}"
                            data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('kategori') ? 'active' : '' }}"
                                        href="{{ route('kategori.index') }}">Kelola Kategori</a></li>
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('kategori/create') ? 'active' : '' }}"
                                        href="{{ route('kategori.create') }}">Tambah Kategori Baru</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- menu --}}
                @can('admin')
                    <li class="nav-item has-submenu">
                        <a class="nav-link submenu-toggle {{ Request::is('menu') ? 'active' : (Request::is('menu/create') ? 'active' : '') }}"
                            data-bs-toggle="collapse" data-bs-target="#submenu-1"
                            aria-expanded="{{ Request::is('menu') ? 'true' : (Request::is('menu/create') ? 'true' : 'false') }}"
                            aria-controls="submenu-1" role="button">
                            <span class="nav-icon">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                            <span class="nav-link-text">Menu</span>
                            <span class="submenu-arrow">
                                <i class="fa-solid fa-chevron-down arrow"></i>
                            </span>
                        </a>
                        <div id="submenu-1"
                            class="submenu submenu-1 {{ Request::is('menu') ? 'collapse show' : (Request::is('menu/create') ? 'collapse show' : 'collapse') }}"
                            data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link {{ Request::is('menu') ? 'active' : '' }}"
                                        href="/menu">Kelola Menu</a></li>
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('menu/create') ? 'active' : '' }}"
                                        href="/menu/create">Tambah Menu Baru</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- meja --}}
                @can('admin')
                    <li class="nav-item has-submenu">
                        <a class="nav-link submenu-toggle {{ Request::is('meja') ? 'active' : (Request::is('meja/create') ? 'active' : '') }}"
                            data-bs-toggle="collapse" data-bs-target="#submenu-5"
                            aria-expanded="{{ Request::is('meja') ? 'true' : (Request::is('meja/create') ? 'true' : 'false') }}"
                            aria-controls="submenu-5" role="button">
                            <span class="nav-icon">
                                <i class="fa-solid fa-chair"></i>
                            </span>
                            <span class="nav-link-text">Meja</span>
                            <span class="submenu-arrow">
                                <i class="fa-solid fa-chevron-down arrow"></i>
                            </span>
                        </a>
                        <div id="submenu-5"
                            class="submenu submenu-5 {{ Request::is('meja') ? 'collapse show' : (Request::is('meja/create') ? 'collapse show' : 'collapse') }}"
                            data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('meja') ? 'active' : '' }}"
                                        href="{{ route('meja.index') }}">Kelola Meja</a></li>
                                <li class="submenu-item"><a
                                        class="submenu-link {{ Request::is('meja/create') ? 'active' : '' }}"
                                        href="{{ route('meja.create') }}">Tambah Meja Baru</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- transaksi  --}}
                <li class="nav-item has-submenu">
                    <a class="nav-link submenu-toggle {{ Request::is('transaksi') ? 'active' : (Request::is('transaksi/create') ? 'active' : '') }}"
                        data-bs-toggle="collapse" data-bs-target="#submenu-2"
                        aria-expanded="{{ Request::is('transaksi') ? 'true' : (Request::is('transaksi/create') ? 'true' : 'false') }}"
                        aria-controls="submenu-2" role="button">
                        <span class="nav-icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </span>
                        <span class="nav-link-text">Transaksi</span>
                        <span class="submenu-arrow">
                            <i class="fa-solid fa-chevron-down arrow"></i>
                        </span>
                    </a>
                    <div id="submenu-2"
                        class="collapse submenu submenu-2 {{ Request::is('transaksi') ? 'collapse show' : (Request::is('transaksi/create') ? 'collapse show' : 'collapse') }}"
                        data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('transaksi') ? 'active' : '' }}"
                                    href="/transaksi">Kelola Transaksi</a></li>
                            <li class="submenu-item"><a
                                    class="submenu-link {{ Request::is('transaksi/create') ? 'active' : '' }}"
                                    href="/transaksi/create">Buat Pesanan Baru</a></li>
                        </ul>
                    </div>
                </li>

                {{-- activityLog --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('log_aktivitas') ? 'active' : '' }}"
                        href="{{ route('log_aktivitas.index') }}">
                        <span class="nav-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </span>
                        <span class="nav-link-text">Log Aktivitas</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>
