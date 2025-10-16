<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('orderjual.index') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

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
            
        </ul>
    </div>
</aside>
