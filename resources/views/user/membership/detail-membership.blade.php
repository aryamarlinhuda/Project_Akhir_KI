@extends('user.sidebar')
@section('judul_halaman','Detail Membership Product | User')
@section('membership','active')
@section('user.detail-membership')
<div class="container py-3">
    <h1>{{ $data->name }}</h1>
    <hr>
    <img src="{{ asset('storage/'.$data->picture) }}" alt="{{ $data->name }}" class="img-fluid mb-3" height="250px" width="250px">
    <h6>Stock : {{ $data->stock }}</h6>
    <p><i><b>Point Membership : {{ number_format($data->point) }}</b></i></p>
    <p>{{ $data->description }}</p>
    <hr>
    <form action="{{ url('user/membership/'.$data->id.'/order') }}">
        @csrf
        <input type="number" name="quantity" min="1" max="{{ $data->stock }}" value="1">
        <br>
        <button type="submit" class="btn btn-success mt-3 px-5">Exchange</button>
    </form>
    <a href="{{ url('user/membership') }}" class="btn btn-danger">Back</a>
</div>
@endsection