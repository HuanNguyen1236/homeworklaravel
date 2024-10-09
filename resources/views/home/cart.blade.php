@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    {{-- <div class="text-center">
        <div class="card">
            <h5 class="card-header">Cart order</h5>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><img src="{{ asset('img/img.jpg') }}" alt="" style="width:30%"></th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row"><img src="{{ asset('img/img.jpg') }}" alt="" style="width:30%"></th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row"><img src="{{ asset('img/img.jpg') }}" alt="" style="width:30%"></th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
              <div>
                <a href="#" class="btn btn-light">Total to pay : Price</a>
                <a href="#" class="btn btn-success">Purchase</a>
                <a href="#" class="btn btn-danger">Remove all product in cart</a>
              </div>
            </div>
          </div>
    </div> --}}
@endsection
