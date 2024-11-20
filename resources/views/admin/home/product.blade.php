@extends('admin.adminpanel')
@section('content')
    <div class="card">
        <div class="card-header" style="justify-content: space-between; display:flex;">
            <h2>List product</h2>
            <a type="button" class="btn btn-primary" href='{{ route('createnewproduct') }}'> + Add new product</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th><input type="checkbox"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td><img src="{{ asset($product->image) }}" alt="" style="width:30%">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td style="display:flex">
                                <a class="btn btn-info" href="{{ route('product.edit', ['id' => $product->id]) }}" >Edit
                                    product</a>
                                <a class="btn btn-danger"
                                    href="{{ route('admin.removeProduct', ['id' => $product->id]) }}">Delete product</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div style="text-align: end">
                <a href="{{ route('clearProduct') }}" class="btn btn-danger">Remove all product</a>
            </div>
        </div>
    </div>
@endsection
