<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'REKAM MEDIS DUSTIRA')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #009765;
            --secondary-color: #ffffff; 
            --sidebar-bg: rgb(54, 125, 197);
            --text-color: #000000;
        }

        body {
            background-color: #f8f9fa;
            color: var(--text-color);
            margin: 24px;
        }

        .navbar-top {
            background-color: rgb(54, 125, 197);
            position: sticky;
            border-radius: 8px;
            z-index: 10;
        }

        .navbar-top .nav-link, .navbar-top .navbar-brand {
            color: var(--secondary-color) !important;
        }

        .sidebar {
            background-color: rgb(54, 125, 197);
            height: 90vh;
            top: 80px; /* Jarak dari navbar */
            left: 0;
            width: 240px; /* Lebar sidebar */
            padding-top: 12px;
            padding-left: 4px;
            color: rgb(128, 197, 54);
            border-radius: 8px; /* Radius sudut sidebar */
        }

        .sidebar .nav-link {
            color: var(--secondary-color);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .sidebar .nav-link:hover {
            color: #adb5bd;
        }

        .content-wrapper {
            margin-left: 260px; /* Menyesuaikan dengan lebar sidebar */
            padding-bottom: 60px;
        }

        .headcard {
            height: 50px;
            border-radius: 6px;
            padding: 25px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card {
            padding: 25px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        footer {
            color: var(--secondary-color);
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            padding: 15px;
        }

        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 105px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-top w-100">
        <div class="container-fluid">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
          <img src="{{ asset('foto/rekammedis.png') }}" width="50" height="50" alt="Logo Rekam Medis" />
          <span class="ms-2 navbar-brand">REKAM MEDIS DUSTIRA</span>
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            
          </li>
          
          @if(auth()->check())
            @php
              $role = session('role');
              $menus = [
                'admin' => [
                    ['label' => 'Pasien', 'route' => 'pasiens.index', 'icon' => 'ti ti-user'],
                    ['label' => 'Rekam Medis', 'route' => 'rekam-medis.index', 'icon' => 'ti ti-file-description'],
                    ['label' => 'Tindakan', 'route' => 'tindakans.index', 'icon' => 'ti ti-tools'],
                    ['label' => 'Obat', 'route' => 'obats.index', 'icon' => 'ti ti-pill'],
                    ['label' => 'Kunjungan', 'route' => 'kunjungans.index', 'icon' => 'ti ti-calendar'],
                    ['label' => 'Dokter', 'route' => 'dokters.index', 'icon' => 'ti ti-stethoscope'],
                    ['label' => 'Poliklinik', 'route' => 'polikliniks.index', 'icon' => 'ti ti-building-hospital'],
                    ['label' => 'Laboratorium', 'route' => 'laboratoriums.index', 'icon' => 'ti ti-microscope'],
                ],
                'dokter' => [
                    ['label' => 'Rekam Medis', 'route' => 'dokter.rekam-medis.index', 'icon' => 'ti ti-file-description'],
                    ['label' => 'Pasien', 'route' => 'dokter.pasiens.index', 'icon' => 'ti ti-user'],
                ],
              ];
            @endphp

            @if(isset($menus[$role]))
              @foreach($menus[$role] as $menu)
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{ route($menu['route']) }}" aria-expanded="false">
                    <span>
                      <i class="{{ $menu['icon'] }}"></i>
                    </span>
                    <span class="hide-menu">{{ $menu['label'] }}</span>
                  </a>
                </li>
              @endforeach
            @endif
          @endif

          
        </ul>
        <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
          <div class="d-flex">
            <div class="unlimited-access-title me-3">
              <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Medical record</h6>
              <a class="btn btn-primary fs-2 fw-semibold lh-sm">Rs Dustira</a>
            </div>
            <div class="unlimited-access-img">
            <!-- <img src="{{ asset('assets/images/backgrounds/rocket.png') }}" alt="" class="img-fluid"> -->
            <img src="{{ asset('foto/rekammedis.png') }}"  alt="" class="img-fluid mr-3" />

            </div>
          </div>
        </div>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!-- Sidebar End -->

    

    <!-- Content -->
    <div class="content-wrapper">
        <div class="headcard mt-4" style="padding: 10px;">
            <h4>@yield('title')</h4>
        </div>
        <div class="card mt-4" style="padding: 20px;">
            @yield('content')
        </div>
        <footer class="footer"></footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.truncate');
            elements.forEach(el => {
                if (el.textContent.length > 20) {
                    el.textContent = el.textContent.substring(0, 20) + '...';
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
