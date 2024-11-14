@extends('admin.adminpanel')
@section('content')
<div class="container">
    <!-- Thông báo thành công hoặc thất bại -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">Edit product</div>
        <div class="card-body">
            <form action="{{ route('product.update', ['id'=> $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left side: Form -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter name" value="{{ old('name', $product->name ?? '') }}" required>
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Enter price" value="{{ old('name', $product->price ?? '') }}" required>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"> {{ $product->description }}</textarea>
                            </div>
                        </div>  
                    </div>
                    <!-- Right side: Image Preview -->
                    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card">
                            <div class="card-header">
                                Image for product
                            </div>
                            <div class="card-body">
                                <!-- Current Image or Image Preview -->
                                <img id="imagePreview" 
                                    src="{{ asset($product->image) }}" 
                                    alt="Image Preview" 
                                    style="max-width: 100%; height: auto; object-fit: contain;">
                                <!-- File upload -->
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image"
                                            onchange="previewImage(event)" required >
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update product</button>
                    {{-- <button type="submit" class="btn btn-danger mt-3">Remove edit</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const imagePreview = document.getElementById('imagePreview');
        reader.onload = function() {
            if (reader.readyState === 2) {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection


