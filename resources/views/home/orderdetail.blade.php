@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="card">
        <div class="card-header">
            List Order
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Total</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderdetails as $orderdetail)
                        <tr>
                            <th scope="col"><img src="{{ asset($orderdetail->product->image) }}" alt="" style="width:30%"></td></th>
                            <th scope="col">{{ $orderdetail->product->name }}</th>
                            <th scope="col">{{ $orderdetail->product->price }}</th>
                            <th scope="col">{{ $orderdetail->quantity }}</th>
                            <th scope="col">{{ $orderdetail->created_at }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
