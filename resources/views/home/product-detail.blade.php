@extends('layouts.app')
@section('title', $product->name)
@section('subtitle', $product->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 ms-auto">
                <img src="{{ asset('img/' . $product->image . '.jpg') }}" class="img-fluid rounded">
            </div>
            <div class="col-lg-4 me-auto">
                <p class="lead"><b><h2>{{ $product->name }}</h2></b></p>
                <p class="lead">{{ $product->price }}</p>
                <p class="lead">{{ $product->description }}</p>
                <a href="#" class="btn btn-primary">Buy now</a>
            </div>
        </div>
    </div>
@endsection