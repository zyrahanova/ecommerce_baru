        <!-- Sidebar -->
        {{-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"> --}}
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #8B4513;">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('dashboard.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gosaint<sup>25</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            {{-- <!-- Nav Item - Galeries -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('galeries') }}">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Galeries</span></a>
            </li> --}}

            <!-- Nav Item - Categories -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="fas fa-list"></i>
                    <span>Kategori</span></a>
            </li>

            <!-- Nav Item - Products -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('product.index') }}">
                    <i class="fas fa-tags"></i>
                    <span>Produk</span></a>
            </li>

            <!-- Nav Item - Customers -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('customer.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Pelanggan</span></a>
            </li>

            <!-- Nav Item - Transaction -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('transaction.index') }}">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transaksi</span></a>
            </li>

            <!-- Nav Item - Cek Ongkir -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('cek-ongkir.index') }}">
                    <i class="fa fa-truck"></i>
                    <span>Cek Ongkir</span></a>
            </li>


            <!-- Nav Item - Contact -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('contact.index') }}">
                    <i class="fas fa-address-book"></i>
                    <span>Kontak Kami</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
