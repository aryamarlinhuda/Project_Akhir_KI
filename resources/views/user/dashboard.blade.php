@extends('user.sidebar')
@section('judul_halaman','Dashboard | User')
@section('dashboard','active')
@section('user.dashboard')
<div class="col-md-6 p-lg-6 text-center mx-auto pt-3">
      <h1 class="display-4 fw-normal"><b>Welcome {{ Auth::user()->name }}!</b></h1>
      <hr>
      <p class="lead fw-normal">Welcome, let's shop for the needs you want only at <b><i>Belibeli.com</i></b></p>
      <a class="btn btn-primary" href="{{ url('user/product') }}">Let's Shop</a>
</div>
<div class="mt-3 conrainer">
    <h3>Membership</h3>
    <hr>
    @if(Auth::user()->membership === 0)
    <p>Want to become one of our Membership Customers? There are many advantages to being a Member here!</p>
    <p>Become a member only by making purchases here with total purchases reaching <i>Rp 10,000,000</i></p>
    <p><b>Your transaction totals : </b><i>Rp {{ number_format($data) }}</i> / Rp 10,000,000</p>
    @else
    <h1>Hello Membership</h1>
    <p>Your Membership Point : {{ number_format ($member->point) }}</p>
    <p>You can exchange membership points for a variety of interesting products!</p>
    <a href="{{ url('user/membership') }}" class="btn btn-success">Exchange points</a>
    @endif
</div>
@endsection