@extends('user.sidebar')
@section('judul_halaman','Transaksi | User')
@section('transaksi','active')
@section('user.transaksi')
<div class="container py-5">
    <h1>Transaction Products</h1>
    <hr>
    @if(empty($data) || count($data) === 0)
        <h3 class="text-white text-center"><i>Tidak ada Transaksi</i></h3>
        <a href="{{ url('user/product') }}" class="btn btn-success offset-md-5 my-3 p-4">Mari Belanja!</a>
    @else
    @if(session('struk'))
    <div class="alert alert-success alert-block dismissible show fade mt-1">
        <div class="alert-body">
            {{session('struk')}}
        </div>
    </div>
    @endif
    @if(session('add'))
    <div class="alert alert-success alert-block dismissible show fade mt-1">
        <div class="alert-body">
            {{session('add')}}
        </div>
    </div>
    @endif
    <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal Transaksi</th>
                <th>Total</th>
                <th>Discount Code</th>
                <th>Discount</th>
                <th>Total Pembelian</th>
                <th>Nominal Pembayaran</th>
                <th>Kembalian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; $kembalian=0; ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->tanggal_transaksi }}</td>
                <td>Rp {{ number_format($item->total)}}</td>
                @if($item->discount_id)
                <td><b>{{ $item->id_disc->code }}</b></td>
                @else
                <td>-</td>
                @endif
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
                @if($item->total_pembelian)
                <?php $kembalian = $item->pembayaran - $item->total_pembelian ?>
                @else
                <?php $kembalian = $item->pembayaran - $item->total ?>
                @endif
                <td>Rp {{ number_format($kembalian) }}</td>
                <td>
                    <a href="{{ url('user/transaksi/'.$item->id_header_transaksi.'/cetak_struk') }}" class="btn btn-primary btn-sm me-4">Cetak Struk</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection