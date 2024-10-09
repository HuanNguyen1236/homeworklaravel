@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-6 col-lg-4 mb-2">
            <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                <img src="{{ asset('img/' . $product->image . '.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        @endforeach
    </div>
@endsection
