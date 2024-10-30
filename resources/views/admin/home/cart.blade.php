@extends('admin.adminpanel')
@section('content')
    <div class="card">
        <div class="card-header">
            List cart
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">User_id</th>
                        <th scope="col">Product_id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">
                            <input type="checkbox" name="" id="">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <th scope="row">{{ $cart->id }}</th>
                            <td><img src="{{ asset($cart->product->image) }}" alt=""
                                    style="width:30%"></td>
                            <td>{{ $cart->user_id }}</td>
                            <td>{{ $cart->product_id }}</td>
                            <td>{{ $cart->product->name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>${{ $cart->quantity * $cart->product->price }}</td>
                            <td>
                                <input type="checkbox">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div style="text-align: end">
                <button type="button" class="btn btn-danger">Remove all cart</button>
            </div>
        </div>
    </div>
@endsection
