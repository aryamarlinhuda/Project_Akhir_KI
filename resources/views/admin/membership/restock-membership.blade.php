@extends('admin.sidebar')
@section('judul_halaman','Restock Membership Products | Admin')
@section('membership','active')
@section('admin.restock-membership')
<div>
    <h1 class="py-3">Restock Membership Product</h1>
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
    <form action="{{ url('admin/membership/'.$data->id.'/restock/process') }}" method="POST" class="col-md-8" enctype="multipart/form-data">
        @csrf
    <div class="mb-3">
        <label for="stock" class="form-label"
        >ReStock</label
        >
        <input
        type="number"
        class="form-control"
        name="stock"
        />
    </div>
    <button type="submit" class="btn btn-primary">Restock</button>
    </form>
</div>
@endsection