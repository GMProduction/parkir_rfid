<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <!-- custom css -->

    <script src="{{ asset('js/swal.js') }}"></script>

</head>

<body>
    <!-- Side-Nav -->
    <div class="side-navbar active-nav d-flex justify-content-between  flex-wrap flex-column" id="sidebar">
        <ul class="nav flex-column text-white w-100 h-100">
            <a href="#" class="nav-link h3 text-white my-2">
                RFID Parkir
            </a>


            <a href="/admin/masterharga">
                <li href="#" class="nav-link t-white">
                    <i class='bx bx-money'></i>
                    <span class="mx-2">Master Harga</span>
                </li>
            </a>
            
            <a href="/admin/admin">
                <li href="#" class="nav-link t-white">
                    <i class='bx bx-user-voice'></i>
                    <span class="mx-2">Data Admin</span>
                </li>
            </a>

            <a href="/admin/petugas">
                <li href="#" class="nav-link t-white">
                    <i class='bx bxs-user-check'></i>
                    <span class="mx-2">Data Petugas</span>
                </li>
            </a>

            <a href="/admin/pelanggan">
                <li href="#" class="nav-link t-white">
                    <i class='bx bxs-face'></i>
                    <span class="mx-2">Data Pelanggan</span>
                </li>
            </a>
            <a href="/admin/topup">
                <li href="#" class="nav-link t-white">
                    <i class='bx bxs-arrow-to-top'></i>
                    <span class="mx-2">Topup</span>
                </li>
            </a>

            <a href="/admin/parkir">
                <li href="#" class="nav-link t-white">
                    <i class='bx bxs-parking'></i>
                    <span class="mx-2">Parkir</span>
                </li>
            </a>

            <a href="/admin/laporan">
                <li href="#" class="nav-link t-white">
                    <i class='bx bx-clipboard'></i>
                    <span class="mx-2">Laporan</span>
                </li>
            </a>
            
            <a href="/logout" class="mt-auto">
                <li href="#" class="nav-link t-white">
                    <i class="bx bx-link-external"></i>
                    <span class="mx-2">Logout</span>
                </li>

            </a>
        </ul>


    </div>

    <!-- Main Wrapper -->
    <div class="p-1 my-container active-cont ">
        <!-- Top Nav -->
        <nav class="navbar top-navbar navbar-light b-white px-5 " style="z-index: 10">
            <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
            <a>@yield('title')</a>
        </nav>
        <!--End Top Nav -->
        <div class="content-wrapper bg-light p-2" style="height: 100vh;">
            @yield('content')
        </div>
    </div>


    <script src="{{ asset('bootstrap/js/jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/myStyle.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @yield('script')
</body>

</html>
