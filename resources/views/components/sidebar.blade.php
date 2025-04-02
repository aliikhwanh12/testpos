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
            <li class="dropdown">
                <a href="javascript:void(0)">
                <iconify-icon icon="mdi:file-report-outline" class="menu-icon"></iconify-icon>
                <span>Laporan</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="javascript:void(0)"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Penjualan</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Pembelian</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Pendapatan</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Pengeluaran</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('manageakun.index') }}">
                <iconify-icon icon="tdesign:user-setting" class="menu-icon"></iconify-icon>
                    <span>Kelola Akun</span>
                </a>
            </li>
            

            <li class="sidebar-menu-group-title">UI Elements</li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
                    <span>Components</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('typography') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Typography</a>
                    </li>
                    <li>
                        <a href="{{ route('colors') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Colors</a>
                    </li>
                    <li>
                        <a href="{{ route('button') }}"><i
                                class="ri-circle-fill circle-icon text-success-main w-auto"></i> Button</a>
                    </li>
                    <li>
                        <a href="{{ route('dropdown') }}"><i
                                class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i> Dropdown</a>
                    </li>
                    <li>
                        <a href="{{ route('alert') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Alerts</a>
                    </li>
                    <li>
                        <a href="{{ route('card') }}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                            Card</a>
                    </li>
                    <li>
                        <a href="{{ route('carousel') }}"><i
                                class="ri-circle-fill circle-icon text-info-main w-auto"></i> Carousel</a>
                    </li>
                    <li>
                        <a href="{{ route('avatar') }}"><i
                                class="ri-circle-fill circle-icon text-success-main w-auto"></i> Avatars</a>
                    </li>
                    <li>
                        <a href="{{ route('progress') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Progress bar</a>
                    </li>
                    <li>
                        <a href="{{ route('tabs') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Tab & Accordion</a>
                    </li>
                    <li>
                        <a href="{{ route('pagination') }}"><i
                                class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Pagination</a>
                    </li>
                    <li>
                        <a href="{{ route('badges') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Badges</a>
                    </li>
                    <li>
                        <a href="{{ route('tooltip') }}"><i
                                class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i> Tooltip & Popover</a>
                    </li>
                    <li>
                        <a href="{{ route('videos') }}"><i class="ri-circle-fill circle-icon text-cyan w-auto"></i>
                            Videos</a>
                    </li>
                    <li>
                        <a href="{{ route('starRating') }}"><i
                                class="ri-circle-fill circle-icon text-indigo w-auto"></i> Star Ratings</a>
                    </li>
                    <li>
                        <a href="{{ route('tags') }}"><i class="ri-circle-fill circle-icon text-purple w-auto"></i>
                            Tags</a>
                    </li>
                    <li>
                        <a href="{{ route('list') }}"><i class="ri-circle-fill circle-icon text-red w-auto"></i>
                            List</a>
                    </li>
                    <li>
                        <a href="{{ route('calendar') }}"><i class="ri-circle-fill circle-icon text-yellow w-auto"></i>
                            Calendar</a>
                    </li>
                    <li>
                        <a href="{{ route('radio') }}"><i class="ri-circle-fill circle-icon text-orange w-auto"></i>
                            Radio</a>
                    </li>
                    <li>
                        <a href="{{ route('switch') }}"><i class="ri-circle-fill circle-icon text-pink w-auto"></i>
                            Switch</a>
                    </li>
                    <li>
                        <a href="{{ route('imageUpload') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Upload</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                    <span>Forms</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('form') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Input Forms</a>
                    </li>
                    <li>
                        <a href="{{ route('formLayout') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Input Layout</a>
                    </li>
                    <li>
                        <a href="{{ route('formValidation') }}"><i
                                class="ri-circle-fill circle-icon text-success-main w-auto"></i> Form Validation</a>
                    </li>
                    <li>
                        <a href="{{ route('wizard') }}"><i
                                class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Form Wizard</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mingcute:storage-line" class="menu-icon"></iconify-icon>
                    <span>Table</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('tableBasic') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Basic Table</a>
                    </li>
                    <li>
                        <a href="{{ route('tableData') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Data Table</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>
                    <span>Chart</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('lineChart') }}"><i
                                class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Line Chart</a>
                    </li>
                    <li>
                        <a href="{{ route('columnChart') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Column Chart</a>
                    </li>
                    <li>
                        <a href="{{ route('pieChart') }}"><i
                                class="ri-circle-fill circle-icon text-success-main w-auto"></i> Pie Chart</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('widgets') }}">
                    <iconify-icon icon="fe:vector" class="menu-icon"></iconify-icon>
                    <span>Widgets</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Users</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('usersList') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Users List</a>
                    </li>
                    <li>
                        <a href="{{ route('usersGrid') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Users Grid</a>
                    </li>
                    <li>
                        <a href="{{ route('addUser') }}"><i
                                class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add User</a>
                    </li>
                    <li>
                        <a href="{{ route('viewProfile') }}"><i
                                class="ri-circle-fill circle-icon text-danger-main w-auto"></i> View Profile</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <i class="ri-user-settings-line text-xl me-6 d-flex w-auto"></i>
                    <span>Role & Access</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('roleAaccess') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Role & Access</a>
                    </li>
                    <li>
                        <a href="{{ route('assignRole') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Assign Role</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('error') }}">
                    <iconify-icon icon="streamline:straight-face" class="menu-icon"></iconify-icon>
                    <span>404</span>
                </a>
            </li>
            <li>
                <a href="{{ route('blankPage') }}">
                    <i class="ri-checkbox-multiple-blank-line text-xl me-6 d-flex w-auto"></i>
                    <span>Blank Page</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
