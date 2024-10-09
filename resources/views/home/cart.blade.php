@extends('layouts.app')
@section('title', 'Trang chu - Online Store')
@section('content')
    <div class="text-center">
        <div class="card">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
              <a href="#" class="btn btn-light">Total to pay : Price</a>
              <a href="#" class="btn btn-success">Purchase</a>
              <a href="#" class="btn btn-danger">Remove all product in cart</a>
            </div>
          </div>
    </div>
@endsection
