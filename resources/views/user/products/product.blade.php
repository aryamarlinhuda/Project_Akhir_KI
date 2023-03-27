@extends('user.sidebar')
@section('judul_halaman','Product | User')
@section('product','active')
@section('user.product')
<div class="container py-3">
    <h1>Products</h1>
    <hr>
    <div class="col-sm-3 mb-4">
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Filter Category
            </button>
            <ul class="dropdown-menu">
                @foreach($data as $category)
                <li><a class="dropdown-item" href="{{ url('user/product/category/'.$category->category) }}">{{ $category->category }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
<div class="row">
    @foreach($data as $item)
        <div class="card text-black col-3 m-2" style="width: 14rem;">
            <img class="card-img-top" src="{{ asset('storage/'.$item->picture) }}" alt="{{ $item->title }}" height="250px">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">{{ Str::limit($item->description, 70) }}</p>
                @if ($item->stock === 0)
                <button class="btn btn-secondary" disabled>Sold Out!</button>
                @else
                <a href="{{ url('user/product/'.$item->product_id) }}" class="btn btn-primary">Read More</a>
                @endif
            </div>
        </div>
    @endforeach
</div>

@endsection