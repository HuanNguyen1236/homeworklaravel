@extends('layouts.app')
@section('title', $product->name)
@section('subtitle', $product->name)
@section('content')
    <div class="container">
        <form action="{{ route('addNewOrder', ['id' => $product->id]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-4 ms-auto">
                    <img src="{{ asset($product->image) }}" class="img-fluid rounded">
                </div>
                <div class="col-lg-4 me-auto">
                    <p class="lead"><b><h2>{{ $product->name }}</h2></b></p>
                    <p class="lead">{{ $product->price }}</p>
                    <p class="lead">{{ $product->description }}</p>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity"> <br>
                    <button type="submit" class="btn btn-primary">Buy now</button>
                </div>
            </div>
        </form>
    </div>
@endsection