@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">My profile</div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Left side: Form -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter name" value="{{ old('name', $user->name ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email', $user->email ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age"
                                    placeholder="Enter your age" value="{{ old('age', $user->age ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter your address" value="{{ old('address', $user->address ?? '') }}">
                            </div>
                        </div>
                        <!-- Right side: Image Preview -->
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                            <div class="card">
                                <div class="card-header">
                                    My avatar
                                </div>
                                <div class="card-body">
                                    <!-- Current Image or Image Preview -->
                                    <img id="imagePreview" 
                                        src="{{ $user->avatar ? asset($user->avatar) : '#' }}" 
                                        alt="Image Preview" 
                                        style="max-width: 100%; height: auto; object-fit: contain;">
                                    <!-- File upload -->
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                                onchange="previewImage(event)">
                                            <label class="custom-file-label" for="avatar">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save edit</button>
                    </div>
                </form>
            </div>
        </div>
        <a class="nav-link active btn btn-secondary" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <h4>Logout</h4>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreview');
            reader.onload = function() {
                if (reader.readyState === 2) {
                    imagePreview.src = reader.result;
                    imagePreview.style.display = 'block';
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
