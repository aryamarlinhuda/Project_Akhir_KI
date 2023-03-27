@extends('user.sidebar')
@section('judul_halaman','Detail Product | User')
@section('product','active')
@section('user.detail-product')
<div class="container py-3">
    <h1>{{ $data->name }}</h1>
    <hr>
    <img src="{{ asset('storage/'.$data->picture) }}" alt="{{ $data->name }}" class="img-fluid mb-3" height="250px" width="250px">
    <h5><i>Rp {{ number_format($data->price) }}</i></h5>
    <h6>Stock : {{ $data->stock }}</h6>
    <p><i><b>Point Membership : {{ $data->point }}</b></i></p>
    <p>{{ $data->description }}</p>
    <hr>
    <form action="{{ url('user/product/'.$data->product_id.'/order') }}">
        @csrf
        <input type="number" name="quantity" min="1" max="{{ $data->stock }}" value="1">
        <br>
        <button type="submit" class="btn btn-success mt-3 px-5">Order</button>
    </form>
    <a href="{{ url('user/product') }}" class="btn btn-danger">Back</a>
</div>
@endsection