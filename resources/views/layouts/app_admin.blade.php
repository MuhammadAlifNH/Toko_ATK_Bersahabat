<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin App')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
    <style>
        .wrapper {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px; /* Lebar sidebar saat melebar */
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #e1e1e1;
            transition: width 0.3s ease; /* Transisi saat melebar */
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 8px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: 1px solid transparent; /* Border awal, tidak terlihat */
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        /* CSS untuk sidebar ketika digeser kecil */
        .sidebar.collapsed {
            width: 70px; /* Lebar sidebar ketika digeser kecil */
        }

        .sidebar.collapsed a {
            text-align: center; /* Teks menjadi tengah */
            padding: 8px 0; /* Padding diatur agar teks dan ikon tidak terlalu besar */
        }

        .sidebar.collapsed .sidebar-heading {
            text-align: center;
            padding: 10px 0;
        }

        .sidebar.collapsed .nav-link-text {
            display: none; /* Sembunyikan teks label ketika sidebar kecil */
        }

        .sidebar.collapsed .menu-text {
        display: none; /* Sembunyikan teks "Menu" */
        }

        .sidebar.collapsed .menu-icon {
        display: block; /* Tampilkan ikon */
        }

        /* Konten utama */
        .content {
            transition: margin-left 0.3s;
        }

        /* Margin untuk konten utama saat sidebar digeser kecil */
        .content.collapsed {
            margin-left: 70px; /* Sesuaikan dengan lebar sidebar kecil */
        }

        /* Gaya untuk judul menu */
        .sidebar-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        .menu-icon {
        display: none; /* Sembunyikan ikon secara default */
        }



        .sidebar-heading:hover {
            background-color: #e9ecef; /* Warna latar belakang saat dihover */
        }
    </style>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.show') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
