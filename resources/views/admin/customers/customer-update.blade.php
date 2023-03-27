@extends('admin.sidebar')
@section('judul_halaman','Customer Membership | Admin')
@section('customer','active')
@section('admin.update-costomers')
<h1 class="pt-4">Update Customers</h1>
<hr>
<form action="update/process" method="POST" class="col-md-8" enctype="multipart/form-data">
        @csrf
    <div class="mb-3">
        <label for="membership" class="form-label">Membership : </label>
        <select name="membership">
            @if($data->membership === 1)
            <option value="1" selected>Yes</option>
            <option value="0">No</option>
            @else
            <<option value="1">Yes</option>
            <option value="0" selected>No</option>
            @endif
        </select>
        <button type="submit" class="btn btn-success ms-3">Update</button>
    </div>
</form>
@endsection