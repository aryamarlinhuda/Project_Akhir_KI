@extends('admin.sidebar')
@section('judul_halaman','Recap | Admin')
@section('recap','active')
@section('admin.recap')
<div class="container py-5">
    <h1>Transaction Recap</h1>
    <hr>
    <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Transaction ID</th>
                <th>Username</th>
                <th>Date</th>
                <th>Discount</th>
                <th>Total Purchase</th>
                <th>Payment</th>
                <th>Change</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; $kembalian=0;?>
            @foreach($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->id_header_transaksi }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->tanggal_transaksi }}</td>
                @if($item->discount)
                <td>Rp {{ number_format($item->discount)}}</td>
                @else
                <td>-</td>
                @endif
                @if($item->total_pembelian)
                <td>Rp {{ number_format($item->total_pembelian)}}</td>
                @else
                <td>-</td>
                @endif
                <td>Rp {{ number_format($item->pembayaran) }}</td>
                <?php $kembalian = $item->pembayaran - $item->total ?>
                <td>Rp {{ number_format($kembalian) }}</td>
                <td><a href="{{ url('admin/recap/'.$item->id_header_transaksi.'/detail') }}" class="btn btn-primary">Detail</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection