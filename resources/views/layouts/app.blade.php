<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', 'Online Store')</title>
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg custom-bg-secondary py-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <h2>Online Store</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <div class="navbar-a mx-auto">
                        <a class="nav-link active" href="{{ route('index') }}">
                            <h4>Product</h4>
                        </a>
                        <a class="nav-link active" href="{{ route('cart.index') }}">
                            <h4>Cart</h4>
                        </a>
                        <a class="nav-link active" href="{{ route('order') }}">
                            <h4>Order</h4>
                        </a>
                        <a class="nav-link active" href="{{ route('about') }}">
                            <h4>About</h4>
                        </a>
                        @if (Auth::check())
                            @if (Auth::user()->getRole() == 'admin')
                                <a class="nav-link active" href="{{ route('admin.dashboard') }}"
                                    style="border-right: 2px solid white">
                                    <h4>Admin Dashboard</h4>
                                </a>
                            @endif
                            <a class="nav-link active" href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                <div class="avatar">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset(Auth::user()->avatar) }}"
                                            style="width: 50px; height: 50px; border-radius: 100%; object-fit: cover;">
                                    @else
                                        <p>No avatar uploaded.</p>
                                    @endif
                                </div>
                            </a>
                        @else
                            <a class="nav-link active" href="{{ route('login') }}">
                                <h4>Login</h4>
                            </a>
                            <a class="nav-link active" href="{{ route('register') }}">
                                <h4>Register</h4>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <header class="masthead custom-bg-primary text-white text-center py-4">
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
            <small> Copyright - <a class="text-reset fw-bold text-decoration-none"
                    target="_blank"href="https://twitter.com/">
                    Nguyen Huu Huan
                </a> - <b>CKC</b>
            </small>
        </div>
    </div>
    <!-- footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (đặt sau body) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
