@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-header">
            Products trong Cart
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['products'] as $product)
                        <tr>
                            <td>{{ $product->getId() }}</td>
                            <td><img src="{{ asset($product->image) }}" alt="" style="width:30%;"></td>
                            <td>{{ $product->getName() }}</td>
                            <td>${{ $product->getPrice() }}</td>
                            <td>{{ session('products')[$product->getId()] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="text-end">
                    <a class="btn btn-outline-secondary mb-2"><b>Tong tien:</b> ${{ $viewData['total'] }}</a>
                    <form action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total" value="{{ $viewData['total'] }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <button class="btn bg-primary text-white mb-2">Thanh toán</button>
                    </form>
                    <a href="{{ route('cart.delete') }}">
                        <button class="btn btn-danger mb-2">
                            Xoa tat ca san pham!
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
