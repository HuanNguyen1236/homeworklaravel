<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Layout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 admin-panel">
                <div class="col-md content">
                    <div class="admin-header">
                        Admin Panel
                    </div>
                </div>
                <div class="admin-sidebar">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ route('admin.dashboard') }}" class="menu-link"
                                data-section="user">Home</a></li>
                        <li class="list-group-item"><a href="{{ route('listUser') }}" class="menu-link"
                                data-section="user">User</a></li>
                        <li class="list-group-item"><a href="{{ route('listProduct') }}" class="menu-link"
                                data-section="product">Product</a></li>
                        <li class="list-group-item"><a href="{{ route('listCart') }}" class="menu-link"
                                data-section="cart">Cart</a></li>
                        <li class="list-group-item"><a href="{{ route('index') }}" class="menu-link"
                                data-section="cart">Online Store</a></li>
                        <li class="list-group-item"><a href="#" class="menu-link" data-section="logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Nội dung Bên Phải -->
            <div class="col-md-9 content">
                <div class="shadow p-3 mb-5 bg-white rounded"
                    style="display: flex; justify-content: flex-end; align-items: center;">
                    <h2 style="margin-right: 20px;">{{ Auth::user()->name }}</h2>
                    <img src="{{ asset(Auth::user()->avatar) }}"
                        style="width: 50px; height: 50px; border-radius: 100%; object-fit: cover;">
                </div>
                <!-- Dashboard Section -->
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
