<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Rental Mobil | Dashboard</title>

    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .sidebar { background: linear-gradient(180deg, #1A2744 10%, #243460 100%) !important; }
        .sidebar-brand { background: #111d36 !important; }
        .nav-item .nav-link[aria-expanded="true"],
        .nav-item.active .nav-link {
            background-color: rgba(245, 158, 11, 0.15) !important;
            border-left: 3px solid #F59E0B !important;
        }
        .sidebar .nav-item .nav-link:hover { background-color: rgba(255,255,255,0.08) !important; }
        #sidebarToggle { background-color: rgba(245, 158, 11, 0.3) !important; }
        #sidebarToggle:hover { background-color: #F59E0B !important; }
        .navbar-search .btn-primary, .btn-primary {
            background-color: #1A2744 !important;
            border-color: #1A2744 !important;
        }
        .btn-primary:hover { background-color: #243460 !important; border-color: #243460 !important; }
        #content-wrapper { background-color: #F4F6F9 !important; }
        .bg-primary { background: linear-gradient(135deg, #1A2744, #243460) !important; }
        .bg-info { background: linear-gradient(135deg, #0f6e56, #1D9E75) !important; }
        .bg-warning { background-color: #F59E0B !important; border-color: #F59E0B !important; }
        .icon-circle.bg-primary { background: #1A2744 !important; }
        .text-primary { color: #1A2744 !important; }
        a { color: #1A2744; }
        a:hover { color: #F59E0B; }
        .scroll-to-top { background-color: #1A2744 !important; }

        /* Badge role di topbar */
        .role-badge {
            font-size: 10px; font-weight: 700;
            padding: 2px 8px; border-radius: 10px;
            margin-left: 5px; vertical-align: middle;
        }
        .role-badge.admin { background: #1A2744; color: #F59E0B; }
        .role-badge.user  { background: #F59E0B; color: #fff; }
    </style>
</head>

<body id="page-top">
<div id="wrapper">

    <!-- ====== SIDEBAR ====== -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
           href="{{ session('role') === 'admin' ? url('/dashboard') : url('/mobil') }}">
            <div class="sidebar-brand-icon"><i class="fas fa-car"></i></div>
            <div class="sidebar-brand-text mx-3">Rental Mobil</div>
        </a>

        <hr class="sidebar-divider my-0">

        @if(session('role') === 'admin')
        {{-- ===== MENU ADMIN ===== --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Menu Admin</div>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/mobil') }}">
                <i class="fas fa-fw fa-car"></i>
                <span>Data Mobil</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Addons</div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
               aria-expanded="true" aria-controls="collapseCustomer">
                <i class="fas fa-fw fa-users"></i>
                <span>Customer</span>
            </a>
            <div id="collapseCustomer" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/customer') }}">Daftar Customer</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/rental') }}">
                <i class="fas fa-fw fa-key"></i>
                <span>Penyewaan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/tables') }}">
                <i class="far fa-user"></i>
                <span>Management Pengguna</span>
            </a>
        </li>

        @else
        {{-- ===== MENU USER ===== --}}

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Menu</div>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/mobil') }}">
                <i class="fas fa-fw fa-car"></i>
                <span>Katalog Mobil</span>
            </a>
        </li>

        @endif

        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- ====== END SIDEBAR ====== -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- ====== TOPBAR ====== -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <ul class="navbar-nav ml-auto">

                    <!-- Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">Alerts Center</h6>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">Message Center</h6>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- User Info -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-none d-lg-flex flex-column align-items-center mr-2" style="line-height:1.2;">
    <div style="font-size:11px;font-weight:700;color:#1A2744;">
        {{ session('role') === 'admin' ? 'Admin' : 'User' }}
    </div>
</div>
                            </span>
                           <div style="width: 36px; height: 36px; border-radius: 50%;
                           background: #f5f5f5; color: #1A2744;
                           display: flex; align-items: center; justify-content: center;
                           font-weight: 800; font-size: 14px;
                           border: 2px solid #120e0e; flex-shrink: 0;">
                           {{ session('role') === 'admin' ? 'A' : 'U' }}
                        </div>
                        </a>
                        <!-- Dropdown User -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- Logout yang benar pakai POST -->
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>
            <!-- ====== END TOPBAR ====== -->

            <div class="container-fluid pt-4">
                @yield('content')
            </div>

        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Amanah Rental {{ date('Y') }}</span>
                </div>
            </div>
        </footer>

    </div>
</div>

<!-- Scroll to Top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "Logout" untuk mengakhiri sesi kamu.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
@stack('scripts')

</body>
</html>