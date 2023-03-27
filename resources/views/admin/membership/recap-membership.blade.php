@extends('admin.sidebar')
@section('judul_halaman','Recap Membership Products | Admin')
@section('membership','active')
@section('admin.recap-membership')
<div class="container py-3">
<h1>Exchange Recap Membership Products</h1>
    <hr>
    @if(empty($data) || count($data) == 0)
        <h3 class="text-white text-center"><i>There Is No Product Exchange Recap</i></h3>
    @else
    <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
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
                <td>{{ $item->user_exchange->name }}</td>
                <td>{{ $item->product_membership->name }}</td>
                <td>{{ $item->tanggal_penukaran }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product_membership->point }}</td>
                <td>{{ number_format($item->total_points) }}</td>
            </tr>
            <?php $grandtotal += $item->total_points; ?> 
            @endforeach
            <tr>
                <th colspan="6" class="text-end pt-3" style="border: none;">Total Points Exchanged :</th>
                <th style="border: none;" class="pt-3">{{ number_format($grandtotal) }}</th>
            </tr>
        </tbody>
    </table>
    @endif
</div>
@endsection