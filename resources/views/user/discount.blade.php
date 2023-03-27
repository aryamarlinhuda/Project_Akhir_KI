@extends('user.sidebar')
@section('judul_halaman','Discount | User')
@section('discount','active')
@section('user.discount')
<h1 class="pt-4">Discount Products</h1>
<hr>
@if($habis === 0)
<h1 class="text-center"><i>Sorry, there are no discounts for you :(</i></h1>
@else
@foreach($data as $item)
@if($item->sisa > 0)
<div class="card col-11 text-black mb-3">
  <div class="card-header">
    Discount
    <small class="float-end"><i>x{{ $item->sisa }}</i></small>
  </div>
  <div class="card-body">
    <h5 class="card-title fw-bol
    d">{{ $item->code }}</h5>
    @if(!$item->minimal)
    <p class="card-text">You can get discount <b>{{ $item->discount }}%</b></p>
    @else
    <p class="card-text">You can get discount <b>{{ $item->discount }}%</b> with a minimum purchase <i>Rp {{ number_format($item->minimal) }}</i></p>
    @endif
    <p class="card-text"><small class="text-muted">*Terms and Conditions apply</small></p>
  </div>
</div>
@endif
@endforeach
@endif
@endsection