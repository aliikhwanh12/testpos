<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('dashboard') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                <iconify-icon icon="hugeicons:cashier-02" class="menu-icon"></iconify-icon>
                <span>Penjualan</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('orderjual.index') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Transaksi Penjualan</a>
                    </li>
                    <li>
                        <a href="{{ route('riwayatjual.index') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Riwayat Penjualan</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                <iconify-icon icon="bx:purchase-tag-alt" class="menu-icon"></iconify-icon>
                <span>Pembelian</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('orderbeli.index') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Transaksi Pembelian</a>
                    </li>
                    <li>
                        <a href="{{ route('riwayatbeli.index') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Riwayat Pembelian</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                <iconify-icon icon="icon-park-outline:expenses" class="menu-icon"></iconify-icon>
                <span>Pengeluaran</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('pengeluaran.index') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Lihat & Tambah Pengeluaran</a>
                    </li>
                    <li>
                        <a href="{{ route('kategoriexp.index') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Kategori Pengeluaran</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                <iconify-icon icon="fluent-mdl2:product-release" class="menu-icon"></iconify-icon>
                <span>Produk</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('produk.index') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Kelola Produk</a>
                    </li>
                    <li>
                        <a href="{{ route('kategoriproduk.index') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Kategori Produk</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('laporan.index') }}">
                <iconify-icon icon="mdi:file-report-outline" class="menu-icon"></iconify-icon>
                    <span>Laporan Pendapatan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manageakun.index') }}">
                <iconify-icon icon="tdesign:user-setting" class="menu-icon"></iconify-icon>
                    <span>Kelola Akun</span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>
