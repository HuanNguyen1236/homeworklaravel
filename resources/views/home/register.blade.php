@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
    </div>
    <div class="form-group">    
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
    </div>
    <div class="input-group mb-3">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="avatar" name="avatar" onchange="updateFileName()">
            <label class="custom-file-label" for="avatar">Choose file</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
@endsection
