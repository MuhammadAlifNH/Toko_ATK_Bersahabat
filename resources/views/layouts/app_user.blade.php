<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko ATK Bersahabat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #f5f5f5;
            border-bottom: 1px solid #ccc;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            border-radius: 100%;
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }
        nav {
            display: flex;
            justify-content: space-around;
            padding: 10px;
            background-color: #eee;
            border-bottom: 1px solid #ccc;
        }
        nav a {
            text-decoration: none;
            color: black;
            padding: 10px;
        }
        nav a:hover {
            background-color: #ddd;
        }
        .content {
            padding: 20px;
            min-height: 300px; /* Minimum height for content area */
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #f5f5f5;
            border-top: 1px solid #ccc;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo">
                <img src="photos/logo.png" alt="logo">
                <h1>Toko <span style="color: blue;">A</span><span style="color: red;">T</span><span style="color: green;">K</span> Bersahabat</h1>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
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
    </header>
    <nav>
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="#">About Us</a>
        <a href="#">Contact</a>
    </nav>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        &copy; 2024 Toko ATK Bersahabat. All rights reserved.
    </footer>
</body>
</html>
