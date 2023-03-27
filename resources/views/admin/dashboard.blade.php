@extends('admin.sidebar')
@section('judul_halaman','Dashboard | Admin')
@section('dashboard','active')
@section('admin.dashboard')
<div class="text-white py-5">
    <h1>Welcome {{ Auth::user()->name }}</h1>
    <hr>
</div>
@endsection