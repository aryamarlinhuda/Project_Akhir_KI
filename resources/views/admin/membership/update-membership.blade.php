@extends('admin.sidebar')
@section('judul_halaman','Update Membership Products | Admin')
@section('membership','active')
@section('admin.update-membership')
<div>
    <h1 class="py-3">Update Membership Product</h1>
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