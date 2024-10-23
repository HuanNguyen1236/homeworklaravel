@extends('admin.adminpanel')
@section('content')
<div class="card">
    <div class="card-header">
      List product
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
                  <td><img src="{{ asset('img/' . $product->image . '.jpg') }}" alt="" style="width:30%"></td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->description }}</td>
                  <td>{{ $product->price }}</td>
                  <td>
                    <input type="checkbox">
                  </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection