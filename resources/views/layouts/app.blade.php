<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', 'Online Store')</title>
    <style>
        .avatar {
            width: 50px;  /* Change size as needed */
            height: 50px; /* Change size as needed */
            overflow: hidden;
            border-radius: 50%; /* Makes the avatar circular */
            border: 2px solid #4CAF50; /* Border color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional shadow */
        }

        .avatar-img {
            width: 150%; /* Make image cover the avatar container */
            height: auto; /* Maintain aspect ratio */
            display: block; /* Remove extra space below the image */
        }
    </style>
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
        <div class="container">

            <a class="navbar-brand" href="{{ route('index') }}"><h2>Online Store</h2></a>

            <button class="navbar-toggler" type="button" data-bs- toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria- controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <div class="navbar-nav mx-auto"> <!-- Sử dụng mx-auto để căn giữa -->
                        <a class="nav-link active" href="#"><h4>Product</h4></a>
                        <a class="nav-link active" href="#"><h4>Cart</h4></a>
                        <a class="nav-link active" href="{{ route('about') }}"><h4>About</h4></a>
                    
                        @if (Auth::check()) <!-- Kiểm tra xem người dùng đã đăng nhập chưa -->
                            {{-- <a class="nav-link active" href="{{ route('profile') }}"><h4>Profile</h4></a> <!-- Liên kết đến trang hồ sơ --> --}}
                            <a class="nav-link active" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><h4>Logout</h4></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            
                            <a class="nav-link active" href="#">
                                <div class="avatar">
                                    <img src="{{ asset('img/img.jpg') }}" alt="User Avatar" class="avatar-img">
                                </div>
                            </a>
                        @else
                            <a class="nav-link active" href="{{ route('login') }}"><h4>Login</h4></a>
                            <a class="nav-link active" href="{{ route('register') }}"><h4>Register</h4></a>
                        @endif
                    </div>
                    
                </div>
            </div>  
        </div>
    </nav>
    <header class="masthead bg-primary text-white text-center py-4">
        <div class="container d-flex align-items-center flex-column">
            <h2>@yield('subtitle', $viewData['title'])</h2>
        </div>
    </header>
    <!-- header -->
    <div class="container my-4">
        @yield('content')
    </div>
    <!-- footer -->
    <div class="copyright py-4 text-center text-white">
        <div class="container">

            <small> Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"href="https://twitter.com/">
                    Nguyen Huu Huan
                </a> - <b>CKC</b>
            </small>
        </div>
    </div>
    <!-- footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
