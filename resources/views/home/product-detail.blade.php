@extends('layouts.app')
@section('title', $product->name)
@section('subtitle', $product->name)
@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset($product->image) }}" class="img-fluid rounded">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">
                        {{ $product->name }} (${{ $product->price }})
                    </h2>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">
                    <form method="POST"
                        action='{{ route('cart.add', ['id' => $product->id]) }}'>
                        <div class="row">
                            @csrf
                            <div class="col-auto">
                                <div class="input-group col-auto">
                                    <div class="input-group-text">Quantity</div>
                                    <input type="number" min="1" max="10"
                                        class="form-control
                        quantity-input" name="quantity"
                                        value="1">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn bg-primary text-white" type="submit">Add to
                                    cart</button>
                            </div>
                        </div>
                    </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
