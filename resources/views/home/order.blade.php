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
                        <th scope="col">ID</th>
                        <th scope="col">User_id</th>
                        <th scope="col">Total</th>
                        <th scope="col">Time</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="col">{{ $order->id }}</th>
                            <th scope="col">{{ $order->user_id }}</th>
                            <th scope="col">{{ $order->total }}</th>
                            <th scope="col">{{ $order->created_at }}</th>
                            <th scope="col"><a href="{{ route('order.detail', ['id' => $order->id]) }}">View</a></th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
