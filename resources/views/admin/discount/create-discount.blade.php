@extends('admin.sidebar')
@section('judul_halaman','Create Discount Products | Admin')
@section('discount','active')
@section('admin.create-discount')
<h1 class="pt-4">Create Discount</h1>
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
<form action="create/process" method="POST" class="col-md-8" enctype="multipart/form-data">
    @csrf
<div class="mb-3">
    <label for="code" class="form-label">Code</label>
    <input
    type="text"
    class="form-control"
    id="code"
    name="code"
    />
</div>

<div class="mb-3">
    <label for="discount" class="form-label">Discount</label>
    <input
    type="number"
    class="form-control"
    id="discount"
    name="discount"
    />
</div>

<div class="mb-3">
    <label for="minimal" class="form-label"
    >Minimum</label
    >
    <input
    type="number"
    class="form-control"
    id="minimal"
    name="minimal"
    />
</div>

<div class="mb-3">
    <label for="limit" class="form-label"
    >Limit Use</label
    >
    <input
    type="number"
    class="form-control"
    id="limit"
    name="limit"
    />
</div>

<button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection