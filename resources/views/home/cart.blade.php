@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="text-center">
        <div class="card">
            <h5 class="card-header">Cart order</h5>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total price</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $totalPrice = 0;
                      @endphp
                      @foreach ($carts as $cart)
                          @php
                              $cartTotal = $cart->product->price * $cart->quantity;
                              $totalPrice += $cartTotal;
                          @endphp
                          <tr>
                              <th scope="row"><img src="{{ asset('img/' . $cart->product->image . '.jpg') }}" alt="" style="width:30%"></th>
                              <td>{{ $cart->product->name }}</td>
                              <td>{{ $cart->quantity }}</td>
                              <td>${{ $cart->product->price }}</td>
                              <td>${{ $cartTotal }}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div style="text-align: end;">
                    <h3>Total to pay: ${{ $totalPrice }}</h3>
                    <a href="#" class="btn btn-success">Purchase</a>
                    <a href="{{ route('clearCart') }}" class="btn btn-danger">Remove all product in cart</a>
                </div>
            </div>
          </div>
    </div>
@endsection
