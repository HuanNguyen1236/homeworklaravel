@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>

        <!-- Quản lý Products -->
        <div class="card my-4">
            <div class="card-header">
                <h4>Products Management</h4>
            </div>
            <div class="card-body">
                <p>There are {{ $products->count() }} products in the system.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
            </div>
        </div>

        <!-- Quản lý Accounts -->
        <div class="card my-4">
            <div class="card-header">
                <h4>Accounts Management</h4>
            </div>
            <div class="card-body">
                <p>There are {{ $accounts->count() }} accounts in the system.</p>
                <a href="{{ route('accounts.index') }}" class="btn btn-primary">Manage Accounts</a>
            </div>
        </div>

        <!-- Quản lý Carts -->
        <div class="card my-4">
            <div class="card-header">
                <h4>Carts Management</h4>
            </div>
            <div class="card-body">
                <p>There are {{ $carts->count() }} active carts in the system.</p>
                <a href="{{ route('carts.index') }}" class="btn btn-primary">Manage Carts</a>
            </div>
        </div>
    </div>
@endsection
