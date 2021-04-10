<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('theme/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Session::get('name') }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                <i class="fa fa-th"></i> <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-car"></i> <span>Data Mobil</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-bars"></i> <span>Penjualan</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Data I</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Data II</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
  </aside>
