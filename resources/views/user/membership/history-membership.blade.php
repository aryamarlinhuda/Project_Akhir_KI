@extends('user.sidebar')
@section('judul_halaman','Exchange History | User')
@section('membership','active')
@section('user.history-membership')
<div class="container py-3">
<h1>History Order Membership Products</h1>
    <hr>
    <a href="{{ url('user/membership') }}" class="btn btn-success mx-2">Buy Membership Product</a>
    @if(session('delete'))
    <div class="alert alert-success alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('delete')}}
        </div>
    </div>
    @endif
    @if(empty($data) || count($data) == 0)
        <h3 class="text-white text-center"><i>There Is No Product Exchange History</i></h3>
    @else
    <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Exchange Date</th>
                <th>Quantity</th>
                <th>Point/Qty</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; $grandtotal=0; ?>   
            @foreach($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->product_membership->name }}</td>
                <td>{{ $item->tanggal_penukaran }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product_membership->point }}</td>
                <td>{{ number_format($item->total_points) }}</td>
            </tr>
            <?php $grandtotal += $item->total_points; ?> 
            @endforeach
            <tr>
                <th colspan="5" class="text-end" style="border: none;">Total Points Exchanged :</th>
                <th style="border: none;">{{ number_format($grandtotal) }}</th>
            </tr>
        </tbody>
    </table>
    @endif
</div>
@endsection