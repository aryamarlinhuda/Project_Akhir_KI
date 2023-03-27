@extends('user.sidebar')
@section('judul_halaman','Membership | User')
@section('membership','active')
@section('user.membership')
<h2 class="pt-4">Redemption of Membership Points</h2>
<hr>
<h5>Membership Points that you have : {{ number_format(Auth::user()->point) }}</h5>
<a href="{{ url('user/membership/order') }}" class="btn btn-success me-3">Orders</a>
<a href="{{ url('user/membership/history') }}" class="btn btn-primary">Exchange History</a>
<div class="row">
    @foreach($data as $item)
        <div class="card text-black col-3 m-2" style="width: 14rem;">
            <img class="card-img-top" src="{{ asset('storage/'.$item->picture) }}" alt="{{ $item->title }}" height="250px">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">{{ Str::limit($item->description, 70) }}</p>
                @if ($item->stock === 0)
                <button class="btn btn-secondary" disabled>Sold Out!</button>
                @elseif (Auth::user()->point > $item->point)
                <a href="{{ url('user/membership/'.$item->id.'/detail') }}" class="btn btn-primary">Read More</a>
                @else
                <button class="btn btn-secondary" disabled>Not Enough Points</button>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection