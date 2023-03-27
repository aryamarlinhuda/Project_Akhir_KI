@extends('admin.sidebar')
@section('judul_halaman','Update Products | Admin')
@section('product','active')
@section('admin.update-product')
<div>
    <h1 class="py-3">Update Product</h1>
    <hr>
    @if (count($errors) > 0)
        <div class="col-md-8 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="update/process" method="POST" class="col-md-8" enctype="multipart/form-data">
        @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
        type="text"
        class="form-control"
        id="name"
        name="name"
        value="{{ $data->name }}"
        />
    </div>
    <div class="mb-3">
        <label for="picture" class="form-label">Picture</label>
        <input
        type="file"
        class="form-control"
        id="picture"
        name="picture"
        />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea
        type="description"
        class="form-control"
        id="description"
        name="description"
        >{{ $data->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select name="category" class="form-select">
            <option value="{{ $data->category }}" selected disabled>{{ $data->category }}</option>
            <option value="electronic">Electronics</option>
            <option value="clothing">Clothing</option>
            <option value="book">Books</option>
            <option value="toy">Toys</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label"
        >Stock</label
        >
        <input
        type="number"
        class="form-control"
        id="stock"
        name="stock"
        value="{{ $data->stock }}"
        />
    </div>

    <div class="mb-3">
        <label for="price" class="form-label"
        >Price</label
        >
        <input
        type="number"
        class="form-control"
        id="price"
        name="price"
        value="{{ $data->price }}"
        />
    </div>

    <div class="mb-3">
        <label for="point" class="form-label"
        >Point</label
        >
        <input
        type="number"
        class="form-control"
        id="point"
        name="point"
        value="{{ $data->point }}"
        />
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection